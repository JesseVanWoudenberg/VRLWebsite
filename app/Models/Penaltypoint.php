<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Penaltypoint extends Model
{
    use HasFactory;

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public static function getRacesLeft($penaltypoint): int
    {
        $racesLeft = Race::query()
            ->select('races.*', 'seasons.seasonnumber')
            ->join('seasons', 'races.season_id', '=', 'seasons.id')
            ->whereIn('races.tier_id', (function ($query) {
                $query->from('tiers')
                    ->select('tiers.id')
                    ->where('tiers.tiernumber', '=', 1);
            }))
            ->whereIn('races.raceformat_id', (function ($query) {
                $query->from('raceformats')
                    ->select('raceformats.id')
                    ->where("raceformats.format", "=", 'full')
                    ->orWhere("raceformats.format", "=", 'preseason');
            }))
            ->whereIn('races.id', (function ($query) {
                $query->from('racedrivers')
                    ->select('racedrivers.race_id')
                    ->where('racedrivers.race_id', '=', DB::raw('races.id'));
            }))
            ->whereRaw("
                    CASE WHEN seasonnumber = " . $penaltypoint->race->season->seasonnumber . " THEN
                        IF(races.round >= " . $penaltypoint->race->round . ", TRUE, FALSE)
                    WHEN seasonnumber < " . $penaltypoint->race->season->seasonnumber . " THEN FALSE
                    WHEN seasonnumber > " . $penaltypoint->race->season->seasonnumber . " THEN TRUE
                    END
                ")
            ->orderBy('seasons.seasonnumber', 'desc')
            ->orderBy('races.round', 'desc')
            ->get()->count();

        $penaltypoint['racesleft'] = (11 - $racesLeft);

        if ($racesLeft > 10)
        {
            $penaltypoint['racesleft'] = 0;
        }

        return $racesLeft;
    }
}
