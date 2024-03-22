<div {{ $attributes }}>
    <button class="close-confirm-modal">&times;</button>
    <h1>{{ $status }}? Are you sure?</h1>
    <form action="{{ $url }}" method="POST">
        @csrf
        @method($method)
    <button class="btn btn-primary mt-5 confirm-btn" type="submit">OK</button>
    </form>
</div>
<div class="overlay hidden"></div>

<style>
    .show-confirm-modal {
        font-size: 2rem;
        font-weight: 600;
        padding: 1.75rem 3.5rem;
        margin: 5rem 2rem;
        border: none;
        background-color: #fff;
        color: #444;
        border-radius: 10rem;
        cursor: pointer;
    }

    .close-confirm-modal {
        position: absolute;
        top: 5%;
        right: 5%;
        font-size: 3rem;
        color: #333;
        cursor: pointer;
        border: none;
        background: none;
    }

    /* -------------------------- */
    /* CLASSES TO MAKE MODAL WORK */
    .hidden {
        display: none;
    }

    .confirm-modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 70%;
        text-align: center;
        background-color: white;
        padding: 3rem;
        border-radius: 5px;
        box-shadow: 0 3rem 5rem rgba(0, 0, 0, 0.3);
        z-index: 10;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(3px);
        z-index: 5;
    }

</style>

<script>
    const modal = document.querySelector('.confirm-modal');
    const overlay = document.querySelector('.overlay');
    const btnCloseModal = document.querySelector('.close-confirm-modal');
    const btnsOpenModal = document.querySelectorAll('.show-confirm-modal');
    const btnOK = document.querySelector('.confirm-btn');

    const openModal = function () {
        modal.classList.remove('hidden');
        overlay.classList.remove('hidden');
    };

    const closeModal = function () {
        modal.classList.add('hidden');
        overlay.classList.add('hidden');
    };

    for (let i = 0; i < btnsOpenModal.length; i++)
        btnsOpenModal[i].addEventListener('click', openModal);

    btnCloseModal.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);

    [btnCloseModal, overlay].forEach(function (element) {
        element.addEventListener("click", closeModal);
    });

    document.addEventListener('keydown', function (e) {

        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
</script>
