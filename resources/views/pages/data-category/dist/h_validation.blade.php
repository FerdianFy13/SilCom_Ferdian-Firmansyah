@push('scripts')
    <script defer>
        const restrictInput = (inputElement) => {
            inputElement.addEventListener("input", () => {
                let inputText = inputElement.value;
                inputText = inputText.replace(/[^a-zA-Z ]/g, '');
                inputText = inputText.replace(/ +/g, ' ');

                if (inputText.length > 0 && inputText[0] === ' ') {
                    inputText = inputText.trim();
                }

                inputElement.value = inputText;
            });
        };

        const restrictNumber = (inputElement) => {
            inputElement.addEventListener("input", () => {
                let inputText = inputElement.value;
                inputText = inputText.replace(/[^0-9 ]/g, '');
                inputText = inputText.replace(/ +/g, ' ');

                if (inputText.length > 0 && inputText[0] === ' ') {
                    inputText = inputText.trim();
                }

                inputElement.value = inputText;
            });
        };

        const restrictValidation = (inputElement) => {
            inputElement.addEventListener("input", () => {
                let input = inputElement.value;
                input = input.replace(/[^a-zA-Z0-9]/g, '');
                input = input.replace(/ +/g, ' ');

                if (input.length > 0 && input[0] === ' ') {
                    input = input.trim();
                }
                inputElement.value = input;
            })
        }
    </script>
@endpush
