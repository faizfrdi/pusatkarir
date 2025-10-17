/**
 * ============================================================
 * HELPER: MERESET FORM & MENYEMBUNYIKAN ERROR
 * ============================================================
 */
function resetForm(form, errorBox = null) {
    if (!form) return;
    form.reset();

    if (errorBox) {
        errorBox.textContent = "";
        errorBox.classList.add("hidden");
    }

    form.querySelectorAll("input, select, textarea").forEach((el) => {
        el.classList.remove("!border-red-500", "focus:!border-red-500", "ring-red-500", "focus:ring-red-500");
        el.style.removeProperty("border-color");
        el.style.removeProperty("box-shadow");
    });
}

/**
 * ============================================================
 * UNIVERSAL HELPER: RESET PESAN ERROR & SUCCESS MODAL
 * ============================================================
 */
function resetModalMessages(...ids) {
    ids.forEach((id) => {
        const el = document.getElementById(id);
        if (el) {
            el.textContent = "";
            el.classList.add("hidden");
        }
    });
}

/**
 * ============================================================
 * HELPER: MEM-PARSE PESAN ERROR VALIDASI LARAVEL
 * ============================================================
 */
function parseLaravelErrors(data, defaultMessage = "Something went wrong. Please try again.", role = null) {
    if (data?.errors) {
        const ignoredFields = (role === "alumni" || role === "employer") ? ["name", "email", "password"] : [];
        const messages = Object.entries(data.errors)
            .filter(([field]) => !ignoredFields.includes(field))
            .map(([field, msgArr]) => {
                const msg = msgArr.join(" ");
                const lower = msg.toLowerCase();

                if (lower.includes("required")) return `${humanize(field)} is required.`;
                if (lower.includes("taken")) return "This email is already registered.";
                if (lower.includes("invalid")) return field === "email" ? "Invalid email address." : "Invalid value.";
                if (lower.includes("confirmation")) return "Passwords do not match.";
                if (lower.includes("min")) return "Password must be at least 8 characters.";
                if (lower.includes("image")) return "Photo must be an image.";
                if (lower.includes("photo")) return "A photo must be uploaded.";
                return msg;
            });

        return messages.length ? messages[0] : defaultMessage;
    }

    if (data?.message) {
        const msg = data.message.toLowerCase();
        if (msg.includes("email or password") || msg.includes("credentials") || msg.includes("records")) return "Invalid email or password.";
        if (msg.includes("password")) return "Password is invalid.";
        if (msg.includes("token")) return "The reset link has expired or is invalid.";
        if (msg.includes("not found")) return "Email not found.";
        return data.message;
    }

    return defaultMessage;
}

/**
 * Mengubah nama field menjadi lebih mudah dibaca.
 * Contoh: "first_name" -> "First name"
 */
function humanize(str = "") {
    const s = String(str).replace(/[_\-]+/g, " ").trim();
    return s.charAt(0).toUpperCase() + s.slice(1);
}

/**
 * ============================================================
 * LOGIKA UTAMA SCRIPT OTENTIKASI
 * ============================================================
 */
document.addEventListener("DOMContentLoaded", () => {
    // ============================================================
    // Deklarasi Elemen DOM
    // ============================================================
    const loginModal = document.getElementById("loginModal");
    const loginModalContent = document.getElementById("loginModalContent");
    const openLoginModal = document.getElementById("openLoginModal");
    const openLoginModalMobile = document.getElementById("openLoginModalMobile");
    const closeLoginModal = document.getElementById("closeLoginModal");
    const loginForm = document.getElementById("ajaxLoginForm");
    const loginError = document.getElementById("loginError");

    const registerModal = document.getElementById("registerModal");
    const registerModalContent = document.getElementById("registerModalContent");
    const closeRegisterModal = document.getElementById("closeRegisterModal");
    const switchToLogin = document.getElementById("switchToLogin");
    const registerForm = document.getElementById("ajaxRegisterForm");
    const registerError = document.getElementById("registerError");

    const candidateModal = document.getElementById("candidateModal");
    const candidateModalContent = document.getElementById("candidateModalContent");
    const closeCandidateModal = document.getElementById("closeCandidateModal");
    const candidateForm = document.getElementById("ajaxCandidateForm");
    const candidateError = document.getElementById("candidateError");

    const employerModal = document.getElementById("employerModal");
    const employerModalContent = document.getElementById("employerModalContent");
    const closeEmployerModal = document.getElementById("closeEmployerModal");
    const employerForm = document.getElementById("ajaxEmployerForm");
    const employerError = document.getElementById("employerError");
    const photoInput = document.getElementById("photo");
    const previewPhoto = document.getElementById("previewPhoto");

    const forgotPasswordModal = document.getElementById("forgotPasswordModal");
    const forgotPasswordModalContent = document.getElementById("forgotPasswordModalContent");
    const openForgotPasswordModal = document.getElementById("openForgotPasswordModal");
    const closeForgotPasswordModal = document.getElementById("closeForgotPasswordModal");
    const forgotForm = document.getElementById("ajaxForgotPasswordForm");

    const resetPasswordModal = document.getElementById("resetPasswordModal");
    const resetPasswordModalContent = document.getElementById("resetPasswordModalContent");
    const closeResetPasswordModal = document.getElementById("closeResetPasswordModal");
    const resetFormEl = document.getElementById("ajaxResetPasswordForm");

    // ============================================================
    // Helper untuk Animasi Modal
    // ============================================================
    const showModal = (modal, content) => {
        if (!modal || !content) return;
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        setTimeout(() => {
            modal.classList.add("opacity-100");
            content.classList.remove("scale-95", "opacity-0");
            content.classList.add("scale-100", "opacity-100");
        }, 10);
    };

    const hideModal = (modal, content) => {
        if (!modal || !content) return;
        modal.classList.remove("opacity-100");
        content.classList.remove("scale-100", "opacity-100");
        content.classList.add("scale-95", "opacity-0");
        setTimeout(() => {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }, 300);
    };

    // ============================================================
    // Helper untuk Menandai Field yang Error
    // ============================================================
    function highlightFieldErrors(form, data) {
        form.querySelectorAll("input, select, textarea").forEach((el) => {
            el.classList.remove("!border-red-500", "focus:!border-red-500", "ring-red-500", "focus:ring-red-500");
            el.style.setProperty("border-color", "");
        });

        if (data?.errors) {
            Object.keys(data.errors).forEach((field) => {
                const input = form.querySelector(`[name="${field}"]`);
                if (input) {
                    input.classList.add("!border-red-500", "focus:!border-red-500", "ring-red-500", "focus:ring-red-500");
                    input.style.setProperty("border-color", "#ef4444", "important");
                }
            });
        }
    }

    // ============================================================
    // Handler AJAX Universal (untuk Login, Register, dll)
    // ============================================================
    const handleAjaxForm = async (form, errorBox, url, defaultMessage = "An error occurred.", opts = {}) => {
        highlightFieldErrors(form, {});
        resetModalMessages(errorBox.id);

        const formData = new FormData(form);
        const csrf = formData.get("_token");
        const role = formData.get("role") || null;

        try {
            const response = await fetch(url, {
                method: "POST",
                headers: { "X-CSRF-TOKEN": csrf, "Accept": "application/json" },
                body: formData,
            });

            let data = {};
            try { data = await response.json(); } catch { data = {}; }

            if (response.ok) {
                const to = opts.redirectTo || data.redirect || "/";
                window.location.replace(to);
                return;
            }

            const message = parseLaravelErrors(data, defaultMessage, role);
            errorBox.textContent = message;
            errorBox.classList.remove("hidden");
            errorBox.classList.add("error-shake");
            setTimeout(() => errorBox.classList.remove("error-shake"), 500);

            highlightFieldErrors(form, data);
        } catch (err) {
            console.error("AJAX Error:", err);
            errorBox.textContent = defaultMessage;
            errorBox.classList.remove("hidden");
        }
    };

    // ============================================================
    // Event Listeners untuk Interaksi Modal & Form Submit
    // ============================================================

    // --- Login ---
    openLoginModal?.addEventListener("click", () => {
        resetForm(loginForm, loginError);
        showModal(loginModal, loginModalContent);
    });
    openLoginModalMobile?.addEventListener("click", () => {
        resetForm(loginForm, loginError);
        showModal(loginModal, loginModalContent);
    });
    closeLoginModal?.addEventListener("click", () => hideModal(loginModal, loginModalContent));
    loginForm?.addEventListener("submit", (e) => {
        e.preventDefault();
        handleAjaxForm(loginForm, loginError, "/login", "Invalid email or password.", { redirectTo: "/" });
    });

    // --- Register ---
    closeRegisterModal?.addEventListener("click", () => hideModal(registerModal, registerModalContent));
    document.querySelectorAll('a[href$="register"]').forEach((el) => {
        el.addEventListener("click", (e) => {
            e.preventDefault();
            hideModal(loginModal, loginModalContent);
            resetForm(registerForm, registerError);
            showModal(registerModal, registerModalContent);
        });
    });
    switchToLogin?.addEventListener("click", () => {
        hideModal(registerModal, registerModalContent);
        resetForm(loginForm, loginError);
        showModal(loginModal, loginModalContent);
    });
    registerForm?.addEventListener("submit", (e) => {
        e.preventDefault();
        handleAjaxForm(registerForm, registerError, "/register", "Registration failed.");
    });

    // --- Candidate ---
    document.querySelectorAll('button[name="role"][value="alumni"]').forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            hideModal(registerModal, registerModalContent);
            resetForm(candidateForm, candidateError);
            showModal(candidateModal, candidateModalContent);
        });
    });
    closeCandidateModal?.addEventListener("click", () => hideModal(candidateModal, candidateModalContent));
    document.getElementById("switchToLoginFromCandidate")?.addEventListener("click", () => {
        hideModal(candidateModal, candidateModalContent);
        resetForm(loginForm, loginError);
        showModal(loginModal, loginModalContent);
    });
    candidateForm?.addEventListener("submit", (e) => {
        e.preventDefault();
        handleAjaxForm(candidateForm, candidateError, "/register", "Registration failed.");
    });

    // --- Employer ---
    document.querySelectorAll('button[name="role"][value="employer"]').forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            hideModal(registerModal, registerModalContent);
            resetForm(employerForm, employerError);
            showModal(employerModal, employerModalContent);
        });
    });
    closeEmployerModal?.addEventListener("click", () => hideModal(employerModal, employerModalContent));
    document.getElementById("switchToLoginFromEmployer")?.addEventListener("click", () => {
        hideModal(employerModal, employerModalContent);
        resetForm(loginForm, loginError);
        showModal(loginModal, loginModalContent);
    });
    employerForm?.addEventListener("submit", (e) => {
        e.preventDefault();
        handleAjaxForm(employerForm, employerError, "/register", "Registration failed.");
    });
    if (photoInput && previewPhoto) {
        photoInput.addEventListener("change", () => {
            const file = photoInput.files[0];
            if (file) previewPhoto.src = URL.createObjectURL(file);
        });
    }

    // --- Forgot Password ---
    openForgotPasswordModal?.addEventListener("click", () => {
        hideModal(loginModal, loginModalContent);
        resetForm(forgotForm);
        resetModalMessages("forgotError", "forgotSuccess");
        showModal(forgotPasswordModal, forgotPasswordModalContent);
    });
    closeForgotPasswordModal?.addEventListener("click", () => hideModal(forgotPasswordModal, forgotPasswordModalContent));
    document.getElementById("switchForgotToLogin")?.addEventListener("click", () => {
        hideModal(forgotPasswordModal, forgotPasswordModalContent);
        resetForm(loginForm, loginError);
        showModal(loginModal, loginModalContent);
    });
    forgotForm?.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(forgotForm);
        const csrf = formData.get("_token");
        const forgotError = document.getElementById("forgotError");
        const forgotSuccess = document.getElementById("forgotSuccess");
        
        resetModalMessages("forgotError", "forgotSuccess");
        highlightFieldErrors(forgotForm, {});

        try {
            const response = await fetch("/forgot-password", { method: "POST", headers: { "X-CSRF-TOKEN": csrf, "Accept": "application/json" }, body: formData });
            let data;
            try { data = await response.json(); } catch { data = {}; }

            if (response.ok) {
                forgotSuccess.textContent = data.status || "We have emailed your password reset link!";
                forgotSuccess.classList.remove("hidden");
            } else {
                forgotError.textContent = parseLaravelErrors(data, "Email not found.");
                forgotError.classList.remove("hidden");
                highlightFieldErrors(forgotForm, data);
            }
        } catch (err) {
            console.error("Forgot password error:", err);
            forgotError.textContent = "An error occurred.";
            forgotError.classList.remove("hidden");
        }
    });

    // --- Reset Password ---
    closeResetPasswordModal?.addEventListener("click", () => hideModal(resetPasswordModal, resetPasswordModalContent));
    resetFormEl?.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(resetFormEl);
        const csrf = formData.get("_token");
        const resetError = document.getElementById("resetError");
        const resetSuccess = document.getElementById("resetSuccess");

        resetModalMessages("resetError", "resetSuccess");
        highlightFieldErrors(resetFormEl, {});

        try {
            const response = await fetch("/reset-password", { method: "POST", headers: { "X-CSRF-TOKEN": csrf, "Accept": "application/json" }, body: formData });
            const data = await response.json();

            if (response.ok && data.success) {
                resetSuccess.textContent = data.message || "Password has been reset successfully.";
                resetSuccess.classList.remove("hidden");
                setTimeout(() => (window.location.href = "/"), 1500);
            } else {
                resetError.textContent = parseLaravelErrors(data, "Failed to reset password.");
                resetError.classList.remove("hidden");
                highlightFieldErrors(resetFormEl, data);
            }
        } catch (err) {
            console.error("Reset password error:", err);
            resetError.textContent = "An error occurred.";
            resetError.classList.remove("hidden");
        }
    });
    
    // ============================================================
    // Fungsionalitas Tambahan
    // ============================================================
    // Klik di luar modal untuk menutup
    window.addEventListener("click", (e) => {
        const modals = [
            [loginModal, loginModalContent],
            [registerModal, registerModalContent],
            [candidateModal, candidateModalContent],
            [employerModal, employerModalContent],
            [forgotPasswordModal, forgotPasswordModalContent],
            [resetPasswordModal, resetPasswordModalContent],
        ];
        modals.forEach(([modal, content]) => {
            if (e.target === modal) hideModal(modal, content);
        });
    });

    // Menghilangkan highlight merah saat user mulai mengetik
    document.querySelectorAll("input, select, textarea").forEach((el) => {
        el.addEventListener("input", () => {
            el.classList.remove("!border-red-500", "focus:!border-red-500", "ring-red-500", "focus:ring-red-500");
            el.style.removeProperty("border-color");
        });
    });

    // Toggle visibilitas password
    const togglePasswordVisibility = (toggleBtnId, inputId) => {
        const toggleBtn = document.getElementById(toggleBtnId);
        const input = document.getElementById(inputId);
        if (toggleBtn && input) {
            toggleBtn.addEventListener("click", () => {
                const isPassword = input.type === "password";
                input.type = isPassword ? "text" : "password";
                const icon = toggleBtn.querySelector("i");
                icon.classList.toggle("fa-eye");
                icon.classList.toggle("fa-eye-slash");
            });
        }
    };
    togglePasswordVisibility("toggleLoginPassword", "loginPassword");
    togglePasswordVisibility("toggleRegisterPassword", "registerPassword");
    togglePasswordVisibility("toggleRegisterConfirmPassword", "registerConfirmPassword");
});