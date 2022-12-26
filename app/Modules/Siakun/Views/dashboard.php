<?= $this->extend('themes/MainContainer') ?>


<?= $this->section('content') ?>
<div id="content-wrapper" class="flex flex-col items-center relative">
    <div id="modal" class="w-full h-screen absolute z-50 bg-gray-900/50 flex justify-center items-center hidden">
        <div class="w-5/6 md:w-1/3 p-10 bg-white">
            <div>
                <h1 class="text-lg font-semibold text-center">Apakah Anda yakin menghapus user ini?</h1>
            </div>
            <div class="w-full flex justify-center my-10">
                <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_VmD8Sl.json"  background="rgba(0, 0, 0, 0)"  speed="1"  style="width: 150px; height: 150px;"  loop  autoplay></lottie-player>
            </div>
            <div class="w-full flex flex-row justify-center">
                <a class="mx-1 py-3 px-5 bg-red-400 hover:bg-red-500 text-white rounded" id="modal-confirm">
                    Iya, Hapus
                </a>
                <button onclick="handleModalHide()" id="modal-cancel" class="mx-1 py-3 px-5 bg-sky-400 hover:bg-sky-500 text-white rounded">
                    Batal Hapus
                </button>
            </div>
        </div>
    </div>
    <div id="header-section" class="py-5 bg-gray-500 w-full">
        <h1 class="text-white text-2xl text-center font-semibold">Sistem Informasi Akun</h1>
    </div>
    <div id="page-btn" class="w-11/12 md w-2/3 mt-10">
        <a href="/tambah-akun" class="py-3 px-5 bg-green-400 hover:bg-green-500 text-white rounded">
            <i class="fas fa-plus mr-1"></i>
            Tambah Akun
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
    <div id="page-table" class="w-11/12 md w-2/3 mt-10 p-10 bg-white rounded-lg border">
        <table class="w-full">
            <thead>
                <tr class="bg-violet-500">
                    <th class="text-white py-5">No</th>
                    <th class="text-white py-5">Name</th>
                    <th class="text-white py-5">Email</th>
                    <th class="text-white py-5">
                        <i class="fas fa-cogs"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($userData as $index=>$d):?>
                <tr>
                    <td class="py-5 border-b text-center"><?= $index + 1 ?></td>
                    <td class="py-5 border-b"><?= $d['full_name'] ?></td>
                    <td class="py-5 border-b"><?= $d['email'] ?></td>
                    <td class="py-5 border-b text-center">
                        <button onclick="handleModalShow('<?= $d['uid']?>')" class="py-3 px-3 bg-red-400 hover:bg-red-500 text-white rounded">
                            <i class="fas fa-trash"></i>
                        </button>
                        <a href="/detail-user/<?= $d['uid']?>" class="py-3 px-3 bg-sky-400 hover:bg-sky-500 text-white rounded mx-1">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>


<script>
    const handleModalShow = (val) => {
        $(document).ready(function () {
            $('#modal').removeClass('hidden');
            $('#modal-confirm').attr('href', `/deleteData/${val}`);
        });
    }

    const handleModalHide = () => {
        $(document).ready(function () {
            $('#modal').addClass('hidden');
            $('#modal-confirm').removeAttr(['href']);
        });
    }
</script>
<?= $this->endSection(); ?>