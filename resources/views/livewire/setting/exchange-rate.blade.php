<div>
    <section class="section">
        <div class="card">
            <h5 class="m-3">{{__('Exchange Rate') }}</h5>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class=" justify-content-between mt-3">
                            <div class="row mb-2">
                                <div class="col-3">
                                    <label>{{__('Exchange Rate Dollar')}}</label>
                                    <input class="form-control @error('price') is-invalid @enderror" placeholder="00.00" type="number" wire:model="price">
                                    @error('price')
                                    <span class="invalid-feedback">{{ __($message) }}</span>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <label>{{__('Exchange Rate Riel')}}</label>
                                    <input class="form-control @error('rate') is-invalid @enderror" placeholder="00.00" type="number" wire:model="rate">
                                    @error('rate')
                                    <span class="invalid-feedback">{{ __($message) }}</span>
                                    @enderror
                                </div>
                                <div class="col-2">
                                    <button type="button" wire:click="save" class="btn btn-primary button_save mt-4 float-right">{{__('Save')}}</button>
                                    <span wire:loading>{{__('Saving...')}}</span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="20" class="text-secondary text-center">{{__('No.')}}</th>
                                            <th class="text-secondary text-center">{{__('Currency')}}</th>
                                            <th class="text-secondary">{{__('Rate')}}</th>
                                            <th class="text-secondary text-center">{{__('Date')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($exchange_rate as $i => $item)
                                        <tr class="text-sm">
                                            <td class="text-center"><small>{{ ++$i}}</small></td>
                                            <td class="text-center"><small><span>&#x24; </span>{{number_format($item->price, 2)}}</small></td>
                                            <td class="text"><span>&#6107;</span>
                                                <small>{{number_format($item->rate, 2)}}</small>
                                            </td>
                                            <td class="text-sm text-center" width="180"><small>{{Carbon\Carbon::parse($item->created_at)}} </small></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$exchange_rate->links('livewire.customer-pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>