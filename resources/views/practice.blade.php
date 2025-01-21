@extends('layouts.app')

@section('content')
<div x-data="practiceMode('{{ $practiceText }}')" class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold mb-4">Practice Mode</h1>

    <div class="mb-4">
        <p class="text-lg font-semibold">Random Text</p>
    </div>

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
            @click="generateNewText"
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300"
        >
            New Text
        </button>
    </div>
</div>

<script>
function practiceMode(initialText) {
    return {
        text: initialText,
        userInput: '',
        startTime: null,
        wpm: 0,
        accuracy: 100,
        error: false,

        get formattedText() {
            return this.text.split('').map((char, index) => {
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

            this.error = this.userInput !== this.text.slice(0, this.userInput.length);

            if (this.userInput.length === this.text.length) {
                this.calculateStats();
            }

            this.updateCursor();
        },

        calculateStats() {
            const endTime = new Date();
            const timeElapsed = (endTime - this.startTime) / 60000; // in minutes
            const wordsTyped = this.userInput.trim().split(/\s+/).length;
            this.wpm = Math.round(wordsTyped / timeElapsed);

            const correctChars = this.userInput.split('').filter((char, index) => char === this.text[index]).length;
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

        generateNewText() {
            window.location.reload();
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

