@extends('layouts.app')

@section('content')
<div x-data="typingTutor({{ json_encode($lessons) }}, {{ json_encode($user) }})" class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold mb-4">Typing Tutor</h1>

    <div class="mb-4">
        <label for="difficulty" class="block text-sm font-medium text-gray-700">Difficulty</label>
        <select id="difficulty" name="difficulty" onchange="window.location.href='?difficulty=' + this.value" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
            @foreach($difficultyLevels as $level)
                <option value="{{ $level }}" {{ $difficulty == $level ? 'selected' : '' }}>{{ $level }}</option>
            @endforeach
        </select>
    </div>

    <button
        @click="toggleSound"
        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
        </svg>
        <span x-text="soundMuted ? 'Unmute' : 'Mute'"></span>
    </button>

    <div class="relative mb-4">
        <p id="textToType" class="text-2xl leading-relaxed whitespace-pre-wrap" x-html="formattedText"></p>
        <div id="cursor" class="absolute w-0.5 h-8 bg-black"></div>
    </div>

    <div class="mb-4">
        <input
            x-model="userInput"
            @input="checkInput"
            type="text"
            class="w-full p-2 text-xl border rounded"
            :class="{'border-red-500': error, 'border-green-500': !error}"
            placeholder="Start typing here..."
        >
    </div>

    <div class="flex justify-between items-center">
        <div>
            <p class="text-lg">WPM: <span x-text="wpm"></span></p>
            <p class="text-lg">Accuracy: <span x-text="accuracy"></span>%</p>
        </div>
        <button
            @click="nextLesson"
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300"
            x-show="lessonCompleted"
        >
            Next Lesson
        </button>
    </div>
</div>

<script>
function typingTutor(lessons, user) {
    return {
        lessons: lessons,
        user: user,
        currentLessonIndex: 0,
        userInput: '',
        startTime: null,
        wpm: 0,
        accuracy: 100,
        error: false,
        lessonCompleted: false,
        soundMuted: false,
        sounds: {
            keypress: new Howl({ src: ['/sounds/keypress.mp3'] }),
            success: new Howl({ src: ['/sounds/success.mp3'] }),
            error: new Howl({ src: ['/sounds/error.mp3'] }),
        },

        get currentLesson() {
            return this.lessons[this.currentLessonIndex];
        },

        get formattedText() {
            const text = this.currentLesson.content;
            return text.split('').map((char, index) => {
                if (index < this.userInput.length) {
                    return this.userInput[index] === char
                        ? `<span class="text-green-500">${char}</span>`
                        : `<span class="text-red-500">${char}</span>`;
                }
                return char;
            }).join('');
        },

        checkInput() {
            if (!this.startTime) {
                this.startTime = new Date();
            }

            const currentText = this.currentLesson.content;
            this.error = this.userInput !== currentText.slice(0, this.userInput.length);

            if (this.error) {
                if (!this.soundMuted) this.sounds.error.play();
            } else {
                if (!this.soundMuted) this.sounds.keypress.play();
            }

            if (this.userInput.length === currentText.length) {
                this.calculateStats();
                this.completeLesson();
                if (!this.soundMuted) this.sounds.success.play();
            }

            this.updateCursor();
        },

        calculateStats() {
            const endTime = new Date();
            const timeElapsed = (endTime - this.startTime) / 60000; // in minutes
            const wordsTyped = this.userInput.trim().split(/\s+/).length;
            this.wpm = Math.round(wordsTyped / timeElapsed);

            const correctChars = this.userInput.split('').filter((char, index) => char === this.currentLesson.content[index]).length;
            this.accuracy = Math.round((correctChars / this.userInput.length) * 100);
        },

        updateCursor() {
            const textElement = document.getElementById('textToType');
            const cursorElement = document.getElementById('cursor');
            const textRect = textElement.getBoundingClientRect();
            const chars = textElement.querySelectorAll('span');

            if (chars.length > 0 && this.userInput.length < chars.length) {
                const currentChar = chars[this.userInput.length];
                const charRect = currentChar.getBoundingClientRect();

                cursorElement.style.left = `${charRect.left - textRect.left}px`;
                cursorElement.style.top = `${charRect.top - textRect.top}px`;
            }
        },

        completeLesson() {
            this.lessonCompleted = true;
            fetch('{{ route('typing.complete') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    lesson_id: this.currentLesson.id,
                    wpm: this.wpm,
                    accuracy: this.accuracy
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.user = data.user;
                }
            });
        },

        nextLesson() {
            this.currentLessonIndex = (this.currentLessonIndex + 1) % this.lessons.length;
            this.userInput = '';
            this.startTime = null;
            this.wpm = 0;
            this.accuracy = 100;
            this.error = false;
            this.lessonCompleted = false;

            gsap.to("#textToType", {
                opacity: 0,
                y: -20,
                duration: 0.3,
                onComplete: () => {
                    this.$nextTick(() => {
                        gsap.to("#textToType", {
                            opacity: 1,
                            y: 0,
                            duration: 0.3
                        });
                    });
                }
            });
        },

        toggleSound() {
            this.soundMuted = !this.soundMuted;
            Howler.mute(this.soundMuted);
        },

        init() {
            this.$nextTick(() => {
                this.updateCursor();

                gsap.from("#textToType", {
                    opacity: 0,
                    y: 20,
                    duration: 0.5,
                    ease: "power2.out"
                });

                gsap.to("#cursor", {
                    opacity: 0,
                    repeat: -1,
                    yoyo: true,
                    duration: 0.4
                });
            });
        }
    }
}
</script>
@endsection

