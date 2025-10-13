document.addEventListener("DOMContentLoaded", () => {
    /* === ELEMENTS === */
    const loginModal = document.getElementById('loginModal');
    const loginModalContent = document.getElementById('loginModalContent');
    const openLoginModal = document.getElementById('openLoginModal');
    const openLoginModalMobile = document.getElementById('openLoginModalMobile');
    const closeLoginModal = document.getElementById('closeLoginModal');

    const registerModal = document.getElementById('registerModal');
    const registerModalContent = document.getElementById('registerModalContent');
    const closeRegisterModal = document.getElementById('closeRegisterModal');
    const switchToLogin = document.getElementById('switchToLogin');

    const loginForm = document.getElementById('ajaxLoginForm');
    const registerForm = document.getElementById('ajaxRegisterForm');
    const loginError = document.getElementById('loginError');
    const registerError = document.getElementById('registerError');

    /* === MODAL ANIMATION HELPERS === */
    const showModal = (modal, content) => {
        if (!modal || !content) return;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    };

    const hideModal = (modal, content) => {
        if (!modal || !content) return;
        modal.classList.remove('opacity-100');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    };

    /* === OPEN/CLOSE LOGIN MODAL === */
    if (openLoginModal) openLoginModal.addEventListener('click', () => showModal(loginModal, loginModalContent));
    if (openLoginModalMobile) openLoginModalMobile.addEventListener('click', () => showModal(loginModal, loginModalContent));
    if (closeLoginModal) closeLoginModal.addEventListener('click', () => hideModal(loginModal, loginModalContent));

    window.addEventListener('click', (e) => {
        if (e.target === loginModal) hideModal(loginModal, loginModalContent);
        if (e.target === registerModal) hideModal(registerModal, registerModalContent);
    });

    /* === OPEN REGISTER MODAL (from link) === */
    document.querySelectorAll('a[href$="register"]').forEach(el => {
        el.addEventListener('click', (e) => {
            e.preventDefault();
            hideModal(loginModal, loginModalContent);
            showModal(registerModal, registerModalContent);
        });
    });

    /* === SWITCH REGISTER -> LOGIN === */
    if (switchToLogin) {
        switchToLogin.addEventListener('click', () => {
            hideModal(registerModal, registerModalContent);
            showModal(loginModal, loginModalContent);
        });
    }

    /* === CLOSE REGISTER === */
    if (closeRegisterModal) {
        closeRegisterModal.addEventListener('click', () => hideModal(registerModal, registerModalContent));
    }

    /* === CANDIDATE MODAL HANDLING === */
    const candidateModal = document.getElementById('candidateModal');
    const candidateModalContent = document.getElementById('candidateModalContent');
    const closeCandidateModal = document.getElementById('closeCandidateModal');
    const candidateForm = document.getElementById('ajaxCandidateForm');
    const candidateError = document.getElementById('candidateError');

    // buka modal candidate dari tombol "Continue as Candidate"
    document.querySelectorAll('button[name="role"][value="alumni"]').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            hideModal(registerModal, registerModalContent);
            showModal(candidateModal, candidateModalContent);
        });
    });

    if (closeCandidateModal) {
        closeCandidateModal.addEventListener('click', () =>
            hideModal(candidateModal, candidateModalContent)
        );
    }

    /* === AJAX CANDIDATE REGISTER === */
    if (candidateForm) {
        candidateForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            if (candidateError) {
                candidateError.classList.add('hidden');
                candidateError.textContent = '';
            }

            const formData = new FormData(candidateForm);
            const csrf = formData.get('_token');

            try {
                const response = await fetch("/register", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && (data.success || data.redirect)) {
                    window.location.reload();
                } else {
                    let message = 'Registration failed. Please check your input.';
                    if (data.errors) {
                        message = Object.values(data.errors).flat().join(' ');
                    } else if (data.message) {
                        message = data.message;
                    }
                    candidateError.textContent = message;
                    candidateError.classList.remove('hidden');
                }
            } catch (err) {
                console.error('Candidate Register error:', err);
                candidateError.textContent = "An error occurred. Please try again.";
                candidateError.classList.remove('hidden');
            }
        });
    }

    document.getElementById('switchToLoginFromCandidate')?.addEventListener('click', () => {
            hideModal(candidateModal, candidateModalContent);
            showModal(loginModal, loginModalContent);
        });
        
        /* === EMPLOYER MODAL HANDLING === */
    const employerModal = document.getElementById('employerModal');
    const employerModalContent = document.getElementById('employerModalContent');
    const closeEmployerModal = document.getElementById('closeEmployerModal');
    const employerForm = document.getElementById('ajaxEmployerForm');
    const employerError = document.getElementById('employerError');
    const photoInput = document.getElementById('photo');
    const previewPhoto = document.getElementById('previewPhoto');

    // buka modal employer dari tombol "Continue as Employer"
    document.querySelectorAll('button[name="role"][value="employer"]').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            hideModal(registerModal, registerModalContent);
            showModal(employerModal, employerModalContent);
        });
    });

    if (closeEmployerModal) {
        closeEmployerModal.addEventListener('click', () =>
            hideModal(employerModal, employerModalContent)
        );
    }

    // preview foto
    if (photoInput && previewPhoto) {
        photoInput.addEventListener('change', () => {
            const file = photoInput.files[0];
            if (file) previewPhoto.src = URL.createObjectURL(file);
        });
    }

    /* === AJAX EMPLOYER REGISTER === */
    if (employerForm) {
        employerForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            if (employerError) {
                employerError.classList.add('hidden');
                employerError.textContent = '';
            }

            const formData = new FormData(employerForm);
            const csrf = formData.get('_token');

            try {
                const response = await fetch("/register", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && (data.success || data.redirect)) {
                    window.location.reload();
                } else {
                    let message = 'Registration failed. Please check your input.';
                    if (data.errors) {
                        message = Object.values(data.errors).flat().join(' ');
                    } else if (data.message) {
                        message = data.message;
                    }
                    employerError.textContent = message;
                    employerError.classList.remove('hidden');
                }
            } catch (err) {
                console.error('Employer Register error:', err);
                employerError.textContent = "An error occurred. Please try again.";
                employerError.classList.remove('hidden');
            }
        });
    }

    document.getElementById('switchToLoginFromEmployer')?.addEventListener('click', () => {
        hideModal(employerModal, employerModalContent);
        showModal(loginModal, loginModalContent);
    });

    /* === FORGOT PASSWORD MODAL === */
    const forgotPasswordModal = document.getElementById('forgotPasswordModal');
    const forgotPasswordModalContent = document.getElementById('forgotPasswordModalContent');
    const openForgotPasswordModal = document.getElementById('openForgotPasswordModal');
    const closeForgotPasswordModal = document.getElementById('closeForgotPasswordModal');

    // Buka modal saat klik "Forgot password?"
    openForgotPasswordModal?.addEventListener('click', () => {
        hideModal(loginModal, loginModalContent);
        showModal(forgotPasswordModal, forgotPasswordModalContent);
    });

    // Tutup modal
    closeForgotPasswordModal?.addEventListener('click', () => hideModal(forgotPasswordModal, forgotPasswordModalContent));

    // Balik ke login modal
    document.getElementById('switchForgotToLogin')?.addEventListener('click', () => {
        hideModal(forgotPasswordModal, forgotPasswordModalContent);
        showModal(loginModal, loginModalContent);
    });

    /* === AJAX Forgot Password === */
    const forgotForm = document.getElementById('ajaxForgotPasswordForm');
    if (forgotForm) {
        forgotForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(forgotForm);
            const csrf = formData.get('_token');

            try {
                const response = await fetch("/forgot-password", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    document.getElementById('forgotSuccess').textContent = data.message || "Check your email for the reset link.";
                    document.getElementById('forgotSuccess').classList.remove('hidden');
                    document.getElementById('forgotError').classList.add('hidden');
                } else {
                    document.getElementById('forgotError').textContent = data.message || "Email not found.";
                    document.getElementById('forgotError').classList.remove('hidden');
                }
            } catch (err) {
                console.error('Forgot password error:', err);
                document.getElementById('forgotError').textContent = "Terjadi kesalahan. Coba lagi.";
                document.getElementById('forgotError').classList.remove('hidden');
            }
        });
    }

    /* === TOGGLE PASSWORD VISIBILITY === */
    const togglePasswordVisibility = (toggleBtnId, inputId) => {
        const toggleBtn = document.getElementById(toggleBtnId);
        const input = document.getElementById(inputId);
        if (!toggleBtn || !input) return;

        toggleBtn.addEventListener('click', () => {
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            const icon = toggleBtn.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    };

    togglePasswordVisibility('toggleLoginPassword', 'loginPassword');
    togglePasswordVisibility('toggleRegisterPassword', 'registerPassword');
    togglePasswordVisibility('toggleRegisterConfirmPassword', 'registerConfirmPassword');

    /* === AJAX LOGIN === */
    if (loginForm) {
        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(loginForm);
            const csrf = formData.get('_token');

            try {
                const response = await fetch("/login", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && (data.success || data.redirect)) {
                    window.location.reload();
                } else {
                    const message = data.message || "E-mail atau password salah";
                    loginError.textContent = message;
                    loginError.classList.remove('hidden');
                    loginError.classList.add('error-shake');
                    setTimeout(() => loginError.classList.remove('error-shake'), 500);
                }
            } catch (err) {
                console.error('Login error:', err);
                loginError.textContent = "Terjadi kesalahan. Coba lagi.";
                loginError.classList.remove('hidden');
            }
        });
    }

    /* === AJAX REGISTER === */
    if (registerForm) {
        registerForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            if (registerError) {
                registerError.classList.add('hidden');
                registerError.textContent = '';
            }

            const formData = new FormData(registerForm);
            const csrf = formData.get('_token');

            try {
                const response = await fetch("/register", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && (data.success || data.redirect)) {
                    window.location.reload();
                } else {
                    let message = 'Pendaftaran gagal. Coba lagi.';
                    if (data.errors) {
                        message = Object.values(data.errors).flat().join(' ');
                    } else if (data.message) {
                        message = data.message;
                    }

                    registerError.textContent = message;
                    registerError.classList.remove('hidden');
                    registerError.classList.add('error-shake');
                    setTimeout(() => registerError.classList.remove('error-shake'), 500);
                }
            } catch (err) {
                console.error('Register error:', err);
                registerError.textContent = "Terjadi kesalahan. Coba lagi.";
                registerError.classList.remove('hidden');
            }
        });
    }
});