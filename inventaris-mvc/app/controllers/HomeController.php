<?php
class HomeController extends Controller {
    public function index(): void {
        $this->requireLogin();
        
        $itemModel = $this->model('Item');
        $categoryModel = $this->model('Category');
        $transactionModel = $this->model('Transaction');

        $totalItems = $itemModel->countAll();
        $totalCategories = count($categoryModel->all());
        $lowStockItems = $itemModel->countLowStock(5);
        $recentTransactions = $transactionModel->getRecent(5);

        $this->view('user/index', [
            'title' => 'Dashboard',
            'totalItems' => $totalItems,
            'totalCategories' => $totalCategories,
            'lowStockItems' => $lowStockItems,
            'recentTransactions' => $recentTransactions
        ]);
    }
}