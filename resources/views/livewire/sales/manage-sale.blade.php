<div>
    @if($action == 'list')
    @livewire('sales.sale.sale-list')
    @endif

    @if($action == 'application')
    @livewire('sales.applications.application-list')
    @endif
</div>