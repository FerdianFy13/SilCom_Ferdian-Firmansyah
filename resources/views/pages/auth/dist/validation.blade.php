@push('scripts')
    <script defer>
        const preventUncheck = (checkbox) => {
            if (!checkbox.checked) {
                checkbox.checked = true;
            }
        };

        const togglePasswordIcons = document.querySelectorAll('.toggle-password');

        togglePasswordIcons.forEach((icon) => {
            const passwordInput = icon.previousElementSibling;

            const updateVisibility = () => {
                icon.style.pointerEvents = passwordInput.value.length > 0 ? 'auto' : 'none';
                icon.style.opacity = passwordInput.value.length > 0 ? '1' : '0.5';
            };

            passwordInput.addEventListener('input', updateVisibility);

            icon.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });

            updateVisibility();
        });

        const validateInput = (inputElement) => {
            const inputValue = inputElement.value;

            if (/\s/.test(inputValue)) {
                inputElement.value = inputValue.replace(/\s/g, '');
            }
        };

        const validateUsername = (inputElement) => {
            const inputValue = inputElement.value;

            if (!/^[a-zA-Z]/.test(inputValue)) {
                inputElement.value = inputValue.replace(/[^a-zA-Z]+/, '');
                return;
            }

            const validPattern = /^[a-zA-Z][a-zA-Z0-9]*$/;

            if (!validPattern.test(inputValue)) {
                inputElement.value = inputValue.replace(/[^a-zA-Z0-9]|(?<![a-zA-Z])[0-9]/g, '');
            }
        };

        const validateEmail = (inputElement) => {
            const inputValue = inputElement.value;

            if (!/^[a-zA-Z]/.test(inputValue)) {
                inputElement.value = inputValue.replace(/[^a-zA-Z]+/, '');
                return;
            }

            const validPattern = /^[a-zA-Z][a-zA-Z0-9.@]*$/;

            if (!validPattern.test(inputValue)) {
                inputElement.value = inputValue.replace(/[^a-zA-Z0-9.@]|(?<![a-zA-Z])[0-9.@]|(?<![a-zA-Z0-9@])[@.]/g,
                    '');
            }
        };

        document.addEventListener("DOMContentLoaded", function() {
            const targetElement = document.getElementById('typewriter-text');

            if (targetElement) {
                const originalText = targetElement.textContent.trim();
                const newText =
                    "Embark on your learning journey with Silcom and explore the endless possibilities in the world of mobile technology and automotive excellence. Sign up for our courses and take the first step towards mastering new skills and achieving your career goals.";

                const typeWriter = (text, targetElement) => {
                    let charIndex = 0;
                    const delay = 30;

                    const addChar = () => {
                        if (charIndex < text.length) {
                            targetElement.textContent += text.charAt(charIndex);
                            charIndex++;
                            setTimeout(addChar, delay);
                        } else {
                            setTimeout(() => {
                                deleteText();
                            }, 1000);
                        }
                    };

                    const deleteText = () => {
                        const deleteInterval = setInterval(() => {
                            if (targetElement.textContent.length > 0) {
                                targetElement.textContent = targetElement.textContent.slice(0, -1);
                            } else {
                                clearInterval(deleteInterval);
                                setTimeout(() => {
                                    typeWriter(originalText, targetElement);
                                }, 1000);
                            }
                        }, delay);
                    };

                    targetElement.textContent = '';
                    addChar();
                };

                typeWriter(newText, targetElement);
            } else {
                console.error("Elemen dengan id 'typewriter-text' tidak ditemukan.");
            }
        });
    </script>
@endpush
