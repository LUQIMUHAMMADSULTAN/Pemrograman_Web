<?php
class ItemsController extends Controller {
    public function index(): void {
        $this->requireLogin();
        $itemModel = $this->model('Item');
        
        $limit = 5; // Jumlah data per halaman
        $page = max(1, (int)($_GET['page'] ?? 1));
        $offset = ($page - 1) * $limit;

        $search = trim($_GET['search'] ?? '');
        $categoryId = !empty($_GET['category_id']) ? (int)$_GET['category_id'] : null;

        $totalItems = $itemModel->countAll($search, $categoryId);
        $totalPages = max(1, ceil($totalItems / $limit));
        $items = $itemModel->paginate($limit, $offset, $search, $categoryId);

        $this->view('items/index', [
            'title' => 'Data Barang',
            'items' => $items,
            'categories' => $this->model('Category')->all(),
            'search' => $search,
            'selectedCategory' => $categoryId,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'offset' => $offset
        ]);
    }

    public function create(): void {
        $this->requireLogin();
        $this->view('items/create', [
            'title' => 'Tambah Barang',
            'categories' => $this->model('Category')->all(),
        ]);
    }

    public function store(): void {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('items');
        $input = array_map('trim', $_POST);
        
        if (empty($input['code']) || empty($input['name'])) {
            $this->flash('danger', 'Kode dan Nama barang wajib diisi.');
            $this->redirect('items/create');
        }

        $this->model('Item')->create([
            'code' => $input['code'],
            'name' => $input['name'],
            'category_id' => !empty($input['category_id']) ? (int)$input['category_id'] : null,
            'quantity' => (int)($input['quantity'] ?? 0),
            'unit' => $input['unit'] ?? 'unit',
            'price' => (float)($input['price'] ?? 0),
            'entry_date' => !empty($input['entry_date']) ? $input['entry_date'] : null,
            'description' => $input['description'] ?? ''
        ]);

        $this->flash('success', 'Barang berhasil ditambahkan.');
        $this->redirect('items');
    }

    public function edit(int $id): void {
        $this->requireLogin();
        $item = $this->model('Item')->find($id);
        if (!$item) {
            $this->flash('danger', 'Barang tidak ditemukan.');
            $this->redirect('items');
        }
        $this->view('items/edit', [
            'title' => 'Edit Barang',
            'item' => $item,
            'categories' => $this->model('Category')->all()
        ]);
    }

    public function update(): void {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('items');
        $id = (int)($_POST['id'] ?? 0);
        $input = array_map('trim', $_POST);

        if ($id <= 0 || empty($input['code']) || empty($input['name'])) {
            $this->flash('danger', 'Data tidak valid.');
            $this->redirect('items');
        }

        $this->model('Item')->update($id, [
            'code' => $input['code'],
            'name' => $input['name'],
            'category_id' => !empty($input['category_id']) ? (int)$input['category_id'] : null,
            'quantity' => (int)($input['quantity'] ?? 0),
            'unit' => $input['unit'] ?? 'unit',
            'price' => (float)($input['price'] ?? 0),
            'entry_date' => !empty($input['entry_date']) ? $input['entry_date'] : null,
            'description' => $input['description'] ?? ''
        ]);

        $this->flash('success', 'Barang berhasil diperbarui.');
        $this->redirect('items');
    }

    public function delete(int $id): void {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('items');
        $this->model('Item')->delete($id);
        $this->flash('success', 'Barang berhasil dihapus.');
        $this->redirect('items');
    }
}