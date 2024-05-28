<?php

namespace App\Livewire\Agency\Setting\AwardTarget;

use App\Models\AwardTarget;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Update extends Component
{
    protected $listeners = ['editAwardTarget'];

    public $positionId, $position = [], $awards = [], $positionName;

    public function getPositionById($positionId)
    {

        return Position::with('awardTargets')
            ->whereHas('awardTargets', function () {
            })->where('id', $positionId)->first();
    }

    public function editAwardTarget($positionId)
    {
        $this->positionId = $positionId;
        $this->position = $this->getPositionById($this->positionId);
        $this->positionName = $this->position->name;
        $this->awards = $this->position->awardTargets->toArray();
    }

    public function updateAwardTarget()
    {

        DB::beginTransaction();
        try {
            foreach ($this->awards as $item) {
                AwardTarget::where(
                    'position_id',
                    $item['pivot']['position_id']
                )->where('award_id', $item['pivot']['award_id'])
                    ->update(
                        [
                            'target_sale' => (int)$item['pivot']['target_sale'],
                            'target_recruit' => (int)$item['pivot']['target_recruit'],
                            'salary' => (int)$item['pivot']['salary'],
                            'incentive' => (int)$item['pivot']['incentive'],
                            'override_fee' => (int)$item['pivot']['override_fee']
                        ]
                    );
            }
            DB::commit();
            create_transaction_log('update award target', 'update', 'Update successfully', Auth::user()->name);
            $this->dispatch("alert.message", [
                'type' => 'success',
                'message' => __("Successfully updated")
            ]);
            $this->dispatch('modal.closeModalSetAwardTarget');
            $this->dispatch('refresh_award_target');
        } catch (\Exception $exception) {

            DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.agency.setting.award-target.update');
    }
}
