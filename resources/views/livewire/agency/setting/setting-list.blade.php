<div>
    <div x-data="{ activeTab: 1 }">
        <div class="container">
            <div class="row">
                <!-- Vertical Tabs -->
                <div class=" card col-md-3">
                    <div class="nav flex-column nav-pills mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                        <a x-on:click.prevent="activeTab = 1" :class="{ 'active': activeTab === 1 }" class="nav-link" id="v-pills-tab1" data-bs-toggle="pill" href="#v-pills-home">{{__('Position')}}</a>

                        <a x-on:click.prevent="activeTab = 2" :class="{ 'active': activeTab === 2 }" class="nav-link" id="v-pills-tab2" data-bs-toggle="pill" href="#v-pills-commission">{{__('Commission Fee')}}</a>

                        <a x-on:click.prevent="activeTab = 3" :class="{ 'active': activeTab === 3 }" class="nav-link" id="v-pills-tab3" data-bs-toggle="pill" href="#v-pills-award">{{__('Set Target')}}</a>

                        <a x-on:click.prevent="activeTab = 4" :class="{ 'active': activeTab === 4 }" class="nav-link" id="v-pills-tab4" data-bs-toggle="pill" href="#v-pills-period">{{__('Period of Expiration')}}</a>
                        <!-- Add more tabs as needed -->
                    </div>
                </div>
                <!-- Tab Content -->
                <div class="col-md-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div x-show="activeTab === 1" class="tab-pane fade show active" id="v-pills-home">
                            <!-- Content for Tab 1 -->
                            @livewire('agency.setting.position.position-list')

                        </div>

                        <div x-show="activeTab === 2" class="tab-pane fade" id="v-pills-commission">
                            <!-- Content for Tab 2 -->
                            @livewire('agency.setting.agency-setting',['prop'=> 'commission_fee'])
                        </div>

                        <div x-show="activeTab === 3" class="tab-pane fade" id="v-pills-award">
                            <!-- Content for Tab 3 -->
                            @livewire('agency.setting.award-target.award-target-list')
                        </div>

                        <div x-show="activeTab === 4" class="tab-pane fade" id="v-pills-period">
                            <!-- Content for Tab 4 -->
                            @livewire('agency.setting.agency-setting',['prop'=> 'period_expiration'])
                        </div>

                        <!-- Add more tab content divs as needed -->
                    </div>
                </div>
                <style>
                    .nav-pills .nav-link {
                        color: #484848 !important;
                    }

                    .nav-pills .nav-link.active,
                    .nav-pills .show>.nav-link {
                        background-color: #f5f9ff !important;
                        color: #0b5277 !important;
                        border-bottom: 3px solid #034C72;
                    }
                </style>
            </div>
        </div>
    </div>
</div>
</div>