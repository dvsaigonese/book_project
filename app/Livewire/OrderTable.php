<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class OrderTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Order::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('total_price')
            ->addColumn('shipping_fee')
            ->addColumn('subtotal_price')
            ->addColumn('order_name')
            ->addColumn('order_phone')
            ->addColumn('order_address')
            ->addColumn('order_status', function (Order $model) {
                $html = '';
                if ($model->order_status == 0) {
                    $html .= '<select class="order-status form-select" data-id='.$model->id.'>';
                    $html .= '
                        <option value="0" selected>Pending</option>
                        <option value="1">Processed and ready to ship</option>
                        <option value="2">Out for delivery</option>
                        <option value="3">Delivered</option>
                        <option value="4">Cancelled</option>
                    ';
                } elseif ($model->order_status == 1) {
                    $html .= '<select class="order-status form-select" data-id='.$model->id.'>';
                    $html .= '
                        <option value="0">Pending</option>
                        <option value="1" selected>Processed and ready to ship</option>
                        <option value="2">Out for delivery</option>
                        <option value="3">Delivered</option>
                        <option value="4">Cancelled</option>
                    ';
                } elseif ($model->order_status == 2) {
                    $html .= '<select class="order-status form-select" data-id='.$model->id.'>';
                    $html .= '
                        <option value="0">Pending</option>
                        <option value="1">Processed and ready to ship</option>
                        <option value="2" selected>Out for delivery</option>
                        <option value="3">Delivered</option>
                        <option value="4">Cancelled</option>
                    ';
                } elseif ($model->order_status == 3) {
                    $html .= '<select class="order-status form-select" data-id='.$model->id.'>';
                    $html .= '
                        <option value="0">Pending</option>
                        <option value="1">Processed and ready to ship</option>
                        <option value="2">Out for delivery</option>
                        <option value="3" selected>Delivered</option>
                        <option value="4">Cancelled</option>
                    ';
                } elseif ($model->order_status == 4) {
                    $html .= '<select class="order-status form-select" data-id='.$model->id.' disabled>';
                    $html .= '
                        <option value="0">Pending</option>
                        <option value="1">Processed and ready to ship</option>
                        <option value="2">Out for delivery</option>
                        <option value="3">Delivered</option>
                        <option value="4" selected>Cancelled</option>
                    ';
                }
                $html .= '</select>';
                return $html;
            })
            ->addColumn('payment_status_label', fn ($order) => Order::codes()->firstWhere('payment_status', $order->payment_status)['label'])
            ->addColumn('payment_status', function (Order $model) {
                $html = '';
                if ($model->payment_status == 0) {
                    $html .= '<div class="form-check form-switch">';
                    $html .= '
                        <input class="payment-status form-check-input" type="checkbox" role="switch" data-id=' . $model->id . '>
                    ';
                } elseif ($model->payment_status == 1) {
                    $html .= '<div class="payment-status form-check form-switch">';
                    $html .= '
                        <input class="payment-status form-check-input" type="checkbox" role="switch" data-id=' . $model->id . ' checked disabled>
                    ';
                }
                $html .= '</div>';
                return $html;
            })
            ->addColumn('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),

            Column::make('Total price', 'total_price')
                ->sortable()
                ->searchable(),

            Column::make('Shipping fee', 'shipping_fee')
                ->sortable()
                ->searchable(),

            Column::make('Subtotal price', 'subtotal_price')
                ->sortable()
                ->searchable(),

            Column::make('Order name', 'order_name')
                ->sortable()
                ->searchable(),

            Column::make('Order phone', 'order_phone')
                ->sortable()
                ->searchable(),

            Column::make('Order address', 'order_address')
                ->sortable()
                ->searchable(),

            Column::make('Order status', 'order_status')
                ->sortable()
                ->searchable(),

            Column::make('Payment status', 'payment_status')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::number('total_price'),
            Filter::number('shipping_fee'),
            Filter::number('subtotal_price'),
            Filter::inputText('order_name')->operators(['contains']),
            Filter::inputText('order_phone')->operators(['contains']),
            Filter::inputText('order_address')->operators(['contains']),
            Filter::enumSelect('order_status', 'orders.order_status')
                ->dataSource(\App\Enums\OrderStatusEnum::cases())
                ->optionLabel('orders.order_status'),
            Filter::select('payment_status', 'orders.payment_status')
                ->dataSource(Order::codes())
                ->optionValue('payment_status')
                ->optionLabel('label'),
            Filter::datepicker('created_at', 'created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

//    public function actions(\App\Models\Order $row): array
//    {
//        return [
//            Button::add('edit')
//                ->slot('')
//                ->class('ti-settings btn btn-outline-primary')
//                ->route('admin.order.edit', ['id' => $row->id]),
//        ];
//    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
