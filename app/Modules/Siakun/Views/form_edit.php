<?= $this->extend('themes/MainContainer') ?>


<?= $this->section('content') ?>
<div id="content-wrapper" class="flex flex-col items-center relative">
    <div id="header-section" class="py-5 bg-gray-500 w-full">
        <h1 class="text-white text-2xl text-center font-semibold">Tambah Akun Baru</h1>
    </div>
    <div id="page-btn" class="w-11/12 md w-2/3 mt-10">
        <a href="/" class="py-3 px-5 bg-orange-400 hover:bg-orange-500 text-white rounded">
            <i class="fas fa-arrow-left mr-1"></i>
            Dashboard
        </a>
    </div>
    <?php $session = \Config\Services::session();?>
    <?php if($session->getFlashdata('alert') == 'active'):?>
    <div id="page-alert" class="w-11/12 md w-2/3 mt-10">
        <?php if($session->getFlashdata('alert-success') != null):?>
        <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline"><?= $session->getFlashdata('alert-success') ?></span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
        <?php endif;?>
        <?php if($session->getFlashdata('alert-fail') != null):?>
        <div id="fail-alert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Gagal!</strong>
            <span class="block sm:inline"><?= $session->getFlashdata('alert-fail') ?></span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
        <?php endif;?>
    </div>
    <?php endif;?>
    <div id="page-form" class="w-11/12 md w-2/3 mt-10 p-10 bg-white rounded-lg border">
        <form action="/updateData" method="post" enctype="multipart/form-data">
            <div class="mb-5 hidden">
                <label for="uid" class="font-semibold">UID</label>
                <input type="text" name="uid" class="border w-full rounded py-3 px-5 mt-3" placeholder="email@mail.com" value="<?= $userData['uid']?>">
            </div>
            <div class="mb-5">
                <label for="email" class="font-semibold">Email</label>
                <input type="email" name="email" class="border w-full rounded py-3 px-5 mt-3" placeholder="email@mail.com" value="<?= $userData['email']?>">
            </div>
            <div class="mb-5">
                <label for="password" class="font-semibold">Password</label>
                <input type="password" name="password" class="border w-full rounded py-3 px-5 mt-3" placeholder="Tuliskan Password Anda!" value="<?= $userData['password']?>">
            </div>
            <div class="mb-5">
                <label for="full_name" class="font-semibold">Nama Lengkap</label>
                <input type="text" name="full_name" class="border w-full rounded py-3 px-5 mt-3" placeholder="John Doe" value="<?= $userData['full_name']?>">
            </div>
            <div class="mb-5">
                <label for="address" class="font-semibold">Alamat Tempat Tinggal</label>
                <input type="text" name="address" class="border w-full rounded py-3 px-5 mt-3" placeholder="Jl. Patimura No 101" value="<?= $userData['address']?>">
            </div>
            <div class="mb-5">
                <label for="gender" class="font-semibold">Jenis Kelamin</label>
                <select name="gender" class="border w-full rounded py-3 px-5 mt-3">
                    <option value="L">Pilih salah satu</option>
                    <option value="L" <?= $userData['gender'] == 'L'? 'selected': '' ?>>Laki-Laki</option>
                    <option value="P" <?= $userData['gender'] == 'P'? 'selected': '' ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-5">
                <button type="submit" class="py-3 px-5 text-white bg-sky-400 hover:bg-sky-500 rounded">
                    <i class="fas fa-save mr-1"></i>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>