<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Hero extends Model implements SluggableInterface {

	use SoftDeletes, SluggableTrait;

	protected $table = 'heroes';

	protected $fillable = [
		'name',
		'slug',
		'overview',
		'description',
		'birth_date',
		'gender',
		'address',
		'city',
		'state',
		'zip',
		'hospital_name',
		'hospital_location',
		'cancer_type',
		'facebook_url',
		'twitter_url',
		'youtube_url',
		'caringbridge_url',
		'raised',
		'active',
		'funded',
		'file_id',
		'nominee_id',
		'sidekick_id'
	];

	protected $dates = [
		'deleted_at',
		'birth_date'
	];

	protected $sluggable = [
		'build_from' => 'name',
		'save_to' => 'slug',
	];

	public function file() {
		return $this->belongsTo('App\File');
	}

	public function age() {
		$born = strtotime($this->birth_date);

		$age = date('Y') - date('Y', $born);

		if (strtotime('+'.$age.' years', $born) > time()) {
			$age--;
		}

		return $age;
	}

	public function days_on_campaign() {
		$then_ts = strtotime($this->created_at);
		$now_ts = time();

		$diff = floor(($now_ts - $then_ts) / (24 * 60 * 60));

		return $diff;
	}

	public function goal() {
		$goal = 0;

		foreach ($this->packages as $package) {
			$goal += $package->cost;
		}

		return $goal;
	}

	public function percent() {
		$percent = floor(($this->raised / $this->goal) * 100);

		return ($percent > 100) ? 100 : $percent;
	}

	public function packages() {
		return $this->belongsToMany('\App\Package');
	}

	public function products() {
		return $this->belongsToMany('\App\Product');
	}

	public function nominee() {
		return $this->belongsTo('\App\User', 'nominee_id');
	}

	public static function closest($limit = 0, $offset = 0) {
		$ids = [];
		$heroes = [];

		$tmp_heroes = self::where('active', '=', 1)->where('funded', '=', 0)->get();

		foreach ($tmp_heroes as $hero) {
			$diff = ($hero->goal() - $hero->raised);

			if ($diff > 0) {
				$ids[$diff] = $hero;
			}
		}

		ksort($ids);

		if ($offset) {
			for ($i = 0; $i <= $limit; $i++) {
				$hero = array_shift($ids);
				$heroes[] = $hero;
			}
		} elseif ($limit > 0) {
			for ($i = 0; $i < $limit; $i++) {
				$hero = array_shift($ids);
				$heroes[] = $hero;
			}
		} else {
			$heroes = $ids;
		}

		if ($offset) {
			$heroes = $heroes[$offset];
		} elseif ($limit == 1) {
			$heroes = $heroes[0];
		} elseif ($limit > 1) {
		}

		return $heroes;
	}

	public static function longest($limit = -1, $offset = 0) {
		if ($offset) {
			$heroes = self::where('active', '=', 1)->where('funded', '=', 0)->orderBy('created_at')->skip($offset)->take($limit)->get();
		} else {
			$heroes = self::where('active', '=', 1)->where('funded', '=', 0)->orderBy('created_at')->limit($limit)->get();
		}
		return ($limit == 1) ? $heroes[0] : $heroes;
	}

	public function contribution_in_cart() {
		$contribution = 0;

		if (session('cart')) {
			foreach (session('cart') as $item) {
				if (isset($item['attributes'])) {
					if ($item['attributes'][39] == $this->id) {
						if (!empty($item['attributes'][38])) {
							$contribution += $item['attributes'][38];
						} else {
							$product = Product::find($item['product_id']);
							$contribution += ($product->contribution_amount * $item['quantity']);
						}
					}
				}
			}
		}

		return is_float($contribution) ? number_format($contribution, 2, '.', '') : $contribution;
	}

}
