<?php require "header.php"; ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="mb-4">
            <h1 class="h3 fw-bold"><?= aman($judul) ?></h1>
            <p class="text-secondary mb-0">
                Isi informasi kontak pada formulir berikut.
            </p>
        </div>

        <?php if ($error !== ""): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Data belum tersimpan.</strong><br>
                <?= aman($error) ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body p-4">
                <form action="<?= aman($aksi) ?>" method="post">
                    <input
                        type="hidden"
                        name="csrf"
                        value="<?= aman($_SESSION["csrf"]) ?>"
                    >

                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">
                            Nama <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            class="form-control"
                            maxlength="150"
                            placeholder="Contoh: Budi Santoso"
                            value="<?= aman($nama) ?>"
                            aria-describedby="namaHelp"
                            required
                        >

                        <div id="namaHelp" class="form-text">
                            Wajib diisi, maksimal 150 karakter.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">
                            Alamat
                        </label>

                        <textarea
                            id="alamat"
                            name="alamat"
                            class="form-control"
                            rows="4"
                            placeholder="Masukkan alamat kontak"
                        ><?= aman($alamat) ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label
                            for="jenis_kelamin"
                            class="form-label fw-semibold"
                        >
                            Jenis Kelamin <span class="text-danger">*</span>
                        </label>

                        <select
                            id="jenis_kelamin"
                            name="jenis_kelamin"
                            class="form-select"
                            required
                        >
                            <option
                                value=""
                                <?= !in_array($jenisKelamin, ["L", "P"], true)
                                    ? "selected" : "" ?>
                            >
                                Pilih jenis kelamin
                            </option>

                            <option
                                value="L"
                                <?= $jenisKelamin === "L" ? "selected" : "" ?>
                            >
                                Laki-laki
                            </option>

                            <option
                                value="P"
                                <?= $jenisKelamin === "P" ? "selected" : "" ?>
                            >
                                Perempuan
                            </option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-4">
                        <a href="index.php" class="btn btn-outline-secondary">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary px-4">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>
