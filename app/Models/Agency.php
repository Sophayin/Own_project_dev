<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Agency extends Model
{
    protected $table = 'agencies';
    protected $fillable = [
        'id',
        'code',
        'agency_id',
        'leader_code',
        'indirect_leader_code',
        'indirect_leader_id',
        'referrer_code',
        'khmer_identity_card',
        'agency_profile',
        'full_name',
        'full_name_translate',
        'phone',
        'phone_telegram',
        'gender',
        'age',
        'position_id',
        'occupation_id',
        'income',
        'status',
        'bank_info',
        'date_of_birth',
        'company',
        'remark',
        'registered_date',
        'schedule_training',
        'created_by',
        'updated_by',
    ];
    use HasFactory;

    public function agency_shop()
    {
        return $this->hasMany(ShopAgency::class);
    }

    public function parent()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }
    public function children()
    {
        return $this->hasMany(Agency::class, 'agency_id');
    }

    public function agency_referrer()
    {
        return $this->hasMany(Agency::class, 'agency_code');
    }

    public function recursive_agency()
    {
        return $this->children()->with('recursive_agency');
    }
    public function address()
    {
        return $this->hasOne(Address::class);
    }
    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function payroll_detail()
    {
        return $this->hasMany(PayrollDetail::class);
    }
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function notification()
    {
        return $this->hasMany(Notification::class);
    }
    public function agency_history()
    {
        return $this->hasMany(AgencyHistory::class, 'agency_id');
    }
    public function uploaded_file()
    {
        return $this->hasOne(Upload::class);
    }


    public function get_agency_id_by_sale()
    {
        $agency_ids = DB::select("WITH RECURSIVE cte AS ( SELECT id, agency_id, status FROM agencies
        UNION SELECT a.id, a.agency_id,a.status FROM agencies a
        JOIN cte ON cte.id = a.agency_id where cte.status IN (1,2))
        SELECT cte.id FROM cte LEFT JOIN applications AS app ON app.agency_id = cte.id
        WHERE app.status = 2");
        $agency_ids = array_column($agency_ids, 'id');
        return $agency_ids;
    }

    public function get_main_agency_id_by_sale()
    {
        $agency = Agency::with('recursive_agency')->whereNotNull('agency_id')->whereIn('status', [1, 2])
            ->whereHas("applications", function ($q) {
                $q->where('status', 2);
            })
            ->groupBy('agency_id')
            ->pluck('agency_id')
            ->toArray();
        return $agency;
    }
}
