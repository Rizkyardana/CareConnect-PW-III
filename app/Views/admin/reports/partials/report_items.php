<?php if (!empty($reports)): ?>
    <?php foreach ($reports as $report): ?>
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                        <?php if (!empty($report['photo'])): ?>
                            <img class="h-10 w-10 rounded-full object-cover" src="/uploads/<?= esc($report['photo']) ?>" alt="">
                        <?php else: ?>
                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            <?= esc($report['title']) ?>
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <?php if (!empty($report['user_name'])): ?>
                    <div class="text-sm text-gray-900"><?= esc($report['user_name']) ?></div>
                <?php else: ?>
                    <div class="text-sm text-red-500 font-medium">User tidak ditemukan</div>
                <?php endif; ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                    <?= ucfirst(esc($report['category'])) ?>
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                    <?= $report['status'] === 'menunggu' ? 'bg-yellow-100 text-yellow-800' : 
                       ($report['status'] === 'diproses' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') ?>">
                    <?= ucfirst($report['status']) ?>
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <?= date('d M Y', strtotime($report['created_at'])) ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex space-x-2">
                    <a href="/admin/reports/<?= $report['id'] ?>" class="text-blue-600 hover:text-blue-900">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                    <form action="/admin/reports/<?= $report['id'] ?>/delete" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
            Tidak ada laporan yang ditemukan.
        </td>
    </tr>
<?php endif; ?>
