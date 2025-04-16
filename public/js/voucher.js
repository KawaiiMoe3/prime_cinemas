document.addEventListener("DOMContentLoaded", function () {
    const addVoucherBtn = document.getElementById("addVoucherBtn");
    if (!addVoucherBtn) return;
    
    addVoucherBtn.addEventListener("click", function (e) {
        e.preventDefault();
        Swal.fire({
            title: "<span style='color: white; font-size: 22px;'>ADD VOUCHER CODE(S)</span>",
            html: `
                <div class="voucher-popup-container">
                    <input type="text" id="voucherCode" class="swal-input-voucher" placeholder="Enter or scan a voucher code">
                    <button id="voucherAddBtn" class="btn-voucher-disabled" disabled>
                        ADD
                    </button>
                </div>
            `,
            background: "#454545",
            showCancelButton: true,
            cancelButtonColor: "transparent",
            cancelButtonText: "CANCEL",
            showConfirmButton: false,
            customClass: { popup: 'custom-swal-voucher' },
            didOpen: () => {
                const voucherInput = document.getElementById("voucherCode");
                const voucherAddBtn = document.getElementById("voucherAddBtn");

                function handleInput() {
                    let value = voucherInput.value.trim();
                    if (value.length >= 6) {
                        voucherAddBtn.disabled = false;
                        voucherAddBtn.className = "btn-voucher-enabled";
                        voucherAddBtn.textContent = "ADD";
                    } else {
                        voucherAddBtn.disabled = true;
                        voucherAddBtn.className = "btn-voucher-disabled";
                        voucherAddBtn.innerHTML = `ADD`;
                    }
                }
                
                function handleAddClick() {
                    if (!voucherAddBtn.disabled) {
                        const code = voucherInput.value.trim();
                        Swal.close();
                        addVoucherCode(code);
                    }
                }
                
                voucherInput.addEventListener("input", handleInput);
                voucherAddBtn.addEventListener("click", handleAddClick);
            }
        });
    });

    function addVoucherCode(code) {
        fetch("/add-voucher", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ voucher_code: code })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: "<span style='color: white;'>Voucher Added!</span>",
                    text: data.message,
                    icon: "success",
                    background: "#454545",
                    confirmButtonText: "CONFIRM",
                    customClass: { 
                        popup: 'custom-swal-popup',
                        confirmButton: 'btn-voucher-enabled'
                    },
                    showCancelButton: false
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: "<span style='color: white;'>Error!</span>",
                    text: "Something went wrong.",
                    icon: "error",
                    background: "#454545",
                    customClass: { popup: 'custom-swal-error', confirmButton: 'btn-voucher-enabled' },
                    confirmButtonText: "CONFIRM",
                    showCancelButton: false
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: "<span style='color: white;'>Error!</span>",
                text: "Something went wrong.",
                icon: "error",
                background: "#454545",
                customClass: { popup: 'custom-swal-error', confirmButton: 'btn-voucher-enabled' },
                confirmButtonText: "CONFIRM",
                showCancelButton: false
            });
        });
    }
});