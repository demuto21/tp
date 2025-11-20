<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - AllSports</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
</head>
<body>
    <div class="login-container">
        <div class="logo">AllSports</div>
        <span class="badge">Admin</span>
        <p class="welcome">Bon retour, cher administrateur !</p>

        <!-- === Messages d'erreur === -->
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <!-- === Formulaire de connexion === -->
        <form method="POST" action="<?php echo e(route('admin.login')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?php echo e(old('email')); ?>"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="password-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="mot_de_passe"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="btn">Se connecter</button>
        </form>

        <div class="footer-link">
            <a href="<?php echo e(url('/')); ?>">Retour au site</a>
        </div>
    </div>

</body>
</html>
<?php /**PATH /home/fred/Documents/TP_Web/resources/views/admin/admin-login.blade.php ENDPATH**/ ?>