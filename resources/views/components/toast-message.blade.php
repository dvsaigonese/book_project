<div id="toastBox"></div>

<style>
    #toastBox {
        z-index: 999999;
        position: fixed;
        top: 25px;
        right: 0%;
        display: flex;
        align-items: flex-end;
        flex-direction: column;
        overflow: hidden;
    }

    .toast-message {
        width: 400px;
        height: 75px;
        background: white;
        font-weight: 500;
        /*margin: 15px 0;*/
        display: flex;
        align-items: center;
        border: 1px solid black;
        position: relative;
        transform: translateX(100%);
        animation: moveleft 0.5s linear forwards;
    }

    @keyframes moveleft {
        100% {
            transform: translateX(0);
        }
    }


    .toast-message i {
        margin: 0 20px;
        font-size: 35px;
        color: #88b750;
    }

    .toast-message.error i{
        color: #d46363;
    }

    .toast-message.warning i {
        color: #d7a306;
    }

    .toast-message::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 10px;
        background: #88b750;
        animation: anim 4000ms linear forwards;
    }

    @keyframes anim {
        100% {
            width: 0;
        }
    }

    .toast-message.error::after {
        background: #d46363;
    }

    .toast-message.warning::after {
        background: #d7a306;
    }
</style>

<script>
    let toastBox = document.getElementById("toastBox");

    function showToast() {
        let toast = document.createElement("div");
        toast.classList.add("toast-message");
        if ("{{ $status }}" == 'success') {
            toast.innerHTML = '<i class="ti-check"></i> {{ $message }}';
        } else if ("{{ $status }}" == 'error') {
            toast.innerHTML = '<i class="ti-close"></i> {{ $message }}';
            toast.classList.add("error");
        } else if ("{{ $status }}" == 'warning') {
            toast.innerHTML = '<i class="ti-alert"></i> {{ $message }}';
            toast.classList.add("warning");
        }
        toastBox.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 4000);
    }

    showToast();
</script>
