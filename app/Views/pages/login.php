<div class="row justify-content-center aling-items-center py-5 my-5">
    <div class="col-lg-3">
        <h1 class="mb-3">Login</h1>
        <form id="<?= $page ?>" action="<?= base_url('login'); ?>" method="post">
            <input type="email" name="email" placeholder="E-mail" class="form-control">
            <input type="password" name="password" placeholder="Senha" class="form-control my-2">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <a href="<?= base_url('cadastrar'); ?>">Cadastre-se</a>
                </div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
            </div>
        </form>
    </div>
</div>