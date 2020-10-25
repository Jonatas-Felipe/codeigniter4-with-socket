<div class="row justify-content-center aling-items-center py-5 my-5">
    <div class="col-lg-3">
        <h1 class="mb-3">Cadastrar - se</h1>
        <form id="<?= $page ?>" action="<?= base_url('register'); ?>" method="post">
            <input type="text" name="name" placeholder="Nome" class="form-control mb-2">
            <input type="email" name="email" placeholder="E-mail" class="form-control">
            <input type="password" name="password" placeholder="Senha" class="form-control my-2">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <a href="<?= base_url(); ?>">Logar-se</a>
                </div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</div>