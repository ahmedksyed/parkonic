<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ParkingSession extends Model
{
    use HasFactory;

    protected $table = 'parking_sessions';
    
    protected $fillable = [
        'location_id', 
        'building_id', 
        'entry_access_point_id', 
        'exit_access_point_id', 
        'vehicle_master_id', 
        'in_time', 
        'out_time', 
        'status'
    ];

    protected $casts = [
        'in_time' => 'datetime',
        'out_time' => 'datetime',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function entryAccessPoint()
    {
        return $this->belongsTo(AccessPoint::class, 'entry_access_point_id');
    }

    public function exitAccessPoint()
    {
        return $this->belongsTo(AccessPoint::class, 'exit_access_point_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(VehicleMaster::class, 'vehicle_master_id');
    }

    public function getDurationAttribute()
    {
        if ($this->out_time && $this->status == 2) {
            $duration = $this->out_time->diffInMinutes($this->in_time);
            
            if ($duration < 60) {
                return $duration . ' min';
            } else {
                $hours = floor($duration / 60);
                $minutes = $duration % 60;
                return $hours . 'h ' . $minutes . 'm';
            }
        }
        
        return null;
    }

    public function getStatusTextAttribute()
    {
        return $this->status == 1 ? 'Active' : 'Closed';
    }
}