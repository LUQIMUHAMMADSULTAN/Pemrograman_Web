<?php
class TransactionsController extends Controller {
    public function index(): void {
        $this->view('transactions/index', [
            'title' => 'Riwayat Transaksi',
            'transactions' => $this->model('Transaction')->all(),
        ]);
    }

    public function create(): void {
        $this->view('transactions/create', [
            'title' => 'Catat Transaksi',
            'items' => $this->model('Item')->all(),
        ]);
    }

    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('transactions');
        $input = array_map('trim', $_POST);

        $itemId = (int)($input['item_id'] ?? 0);
        $qty = (int)($input['quantity'] ?? 0);
        $type = $input['type'] ?? 'IN';
        $notes = $input['notes'] ?? '';

        if ($itemId <= 0 || $qty <= 0) {
            $this->flash('danger', 'Barang dan jumlah transaksi harus valid.');
            $this->redirect('transactions/create');
        }

        $itemModel = $this->model('Item');
        $item = $itemModel->find($itemId);
        if (!$item) {
            $this->flash('danger', 'Barang tidak ditemukan.');
            $this->redirect('transactions/create');
        }

        if ($type === 'OUT' && $item['quantity'] < $qty) {
            $this->flash('danger', 'Stok tidak mencukupi untuk transaksi keluar.');
            $this->redirect('transactions/create');
        }

        $userId = $_SESSION['user_id'] ?? 1;

        $success = $this->model('Transaction')->createTransaction([
            'item_id' => $itemId,
            'user_id' => $userId,
            'type' => $type,
            'quantity' => $qty,
            'notes' => $notes
        ], (int)$item['quantity'], $type);

        if ($success) {
            $this->flash('success', 'Transaksi berhasil dicatat dan stok diperbarui.');
        } else {
            $this->flash('danger', 'Gagal memproses transaksi.');
        }
        $this->redirect('transactions');
    }
}