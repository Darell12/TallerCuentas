<meta>
<link rel="stylesheet" href="<?php echo base_url() ?>/bootstrap/bootstrap.min.css"> <!-- Bootstrap 5 hoja de estilos -->
<link rel="stylesheet" href="<?php echo base_url() ?>/bootstrap-icons/bootstrap-icons.css"> <!-- Bootstrap 5 hoja de estilos iconos -->
<script src="<?php echo base_url() ?>/css/jquery-3.6.0.js"></script>
<script src="<?php echo base_url() ?>/bootstrap/bootstrap.bundle.min.js"></script>
</meta>


<div class="toast-container position-fixed bottom-0 end-0 p-3 top-50 start-50 translate-middle">
    <div id="liveToast" class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <i class="bi bi-bug"></i>
            <strong class="me-auto"> Error</strong>
            <small>Ahora</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Todos los campos deben estar llenos.
        </div>
    </div>
</div>
</div>

<script>
    const toastLiveExample = document.getElementById('liveToast')

    const toast = new bootstrap.Toast(toastLiveExample)

    toast.show()

    setTimeout(() => {
        location.replace( "<?php echo base_url() ?>/departamentos");
    }, 3000);
</script>