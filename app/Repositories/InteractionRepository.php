<?php

namespace App\Repositories;

use App\Models\Block;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Interaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

//use Your Model

/**
 * Class InteractionRepository.
 */
class InteractionRepository
{
    public $filteredUsers = [];
    public function all(Request $request, $company_id)
    {

        $newUsers = [];
        $company = User::where('id', $company_id)->first();
        if (!$company) {
            return response()->json(['data' => 'some thing went wrong!!']);

        }
        $newUsers = $this->unSeenUsers($request['application_id'], $company_id);
        return response()->json(['data' => $newUsers]);
    }
    public function seen(Request $request, $interaction_id)
    {
        $interaction = Interaction::where('id', $interaction_id)->first();
        if (!$interaction) {
            return response()->json(['data' => 'some thing went wrong!!']);
        }
        $interaction->seen = true;
        if ($request->like) {
            if ($request->like == "true") {
                $interaction->like = true;
            } else {
                $interaction->like = false;
            }
        }
        if ($request->comment) {
            $interaction->comment = $request->comment;
        }
        $interaction->save();
        return response()->json(['data' => $interaction]);
    }
    public function filterCreate()
    {
        $cities = City::all();
        $countries = Country::all();
        $categories = Category::where('category_type_id', 2)->get();
        return response()->json(['cities' => $cities, 'countries' => $countries, 'categories' => $categories]);

    }
    public function filterUsers(Request $request, $company_id)
    {
        $allUsers = [];
        $company = User::where('id', $company_id)->first();
        if (!$company) {
            return response()->json(['data' => 'some thing went wrong!!']);
        }
        $allUsers = $this->unSeenUsers($request['application_id'], $company_id);
        // $allUsers = collect($allUsers);
        if (!$allUsers) {
            return response()->json(['data' => 'no users remaining']);
        }
        $this->filteredUsers = $allUsers;
        if ($request->gender) {
            ($request['gender'] == 'male') ? $request['gender'] = 0 : $request['gender'] = 1;
            foreach ($allUsers as $user) {
                $this->setFilterArray($user->userData->gender == $request->gender, $user);
            }
        }
        if ($request->min_hight && $request->max_hight) {
            if ($this->filteredUsers > 0) {
                $allUsers = $this->filteredUsers;
            }

            foreach ($allUsers as $user) {
                $this->setFilterArray($user->userData->hight >= $request->min_hight && $user->userData->hight <= $request->max_hight, $user);
            }
        }
        if ($request->min_weight && $request->max_weight) {
            if ($this->filteredUsers > 0) {
                $allUsers = $this->filteredUsers;
            }
            foreach ($allUsers as $user) {
                $this->setFilterArray($user->userData->weight >= $request->min_weight && $user->userData->weight <= $request->max_weight, $user);
            }
        }
        if ($request->min_age && $request->max_age) {
            if ($this->filteredUsers > 0) {
                $allUsers = $this->filteredUsers;
            }
            foreach ($allUsers as $user) {
                $age = Carbon::parse($user->userData->birth_date)->age;
                $this->setFilterArray($age >= $request->min_age && $age <= $request->max_age, $user);
            }
        }
        if ($request->city_ids) {
            if ($this->filteredUsers > 0) {
                $allUsers = $this->filteredUsers;
            }
            $cities = City::whereIn('id', $request->city_ids)->with('users')->get();
            foreach ($allUsers as $user) {
                $notCityUser = true;
                foreach ($cities as $city) {
                    foreach ($city->users as $cityUser) {
                        if ($user->id == $cityUser->user_id) {
                            $notCityUser = false;
                            if (!in_array($user, $this->filteredUsers)) {
                                array_push($this->filteredUsers, $user);
                            }
                            break 2;
                        }
                    }
                }
                if ($notCityUser) {
                    $pos = array_search($user, $this->filteredUsers);
                    if ($pos) {
                        array_splice($this->filteredUsers, $pos, 1);
                    }
                }
            }
        }
        if ($request->country_ids) {
            if ($this->filteredUsers > 0) {
                $allUsers = $this->filteredUsers;
            }
            $countries = Country::whereIn('id', $request->country_ids)->with('users')->get();
            foreach ($allUsers as $user) {
                $notCountryUser = true;
                foreach ($countries as $country) {
                    foreach ($country->users as $countryUser) {
                        if ($user->id == $countryUser->user_id) {
                            $notCountryUser = false;
                            if (!in_array($user, $this->filteredUsers)) {
                                array_push($this->filteredUsers, $user);
                            }
                            break 2;
                        }
                    }
                }
                if ($notCountryUser) {
                    $pos = array_search($user, $this->filteredUsers);
                    if ($pos) {
                        array_splice($this->filteredUsers, $pos, 1);
                    }
                }
            }
        }
        if ($request->category_ids) {
            if ($this->filteredUsers > 0) {
                $allUsers = $this->filteredUsers;
            }
            $categories = Category::where('application_id', $request['application_id'])->whereIn('id', $request->category_ids)->with('users')->get();
            foreach ($allUsers as $user) {
                $notCategoryUser = true;
                foreach ($categories as $category) {
                    foreach ($category->users as $categoryUser) {
                        if ($user->id == $categoryUser->id) {
                            $notCategoryUser = false;
                            if (!in_array($user, $this->filteredUsers)) {
                                array_push($this->filteredUsers, $user);
                            }
                            break 2;
                        }
                    }
                }
                if ($notCategoryUser) {
                    $pos = array_search($user, $this->filteredUsers);
                    if ($pos) {
                        array_splice($this->filteredUsers, $pos, 1);
                    }
                }
            }
        }
        return response()->json(['data' => $this->filteredUsers]);

    }
    private function setFilterArray($condition, $user)
    {
        if ($condition) {
            if (!in_array($user, $this->filteredUsers)) {
                array_push($this->filteredUsers, $user);
            }
        } else {
            $pos = array_search($user, $this->filteredUsers);
            if ($pos >= 0) {
                array_splice($this->filteredUsers, $pos, 1);
            }
        }
    }
    private function unSeenUsers($application_id, $company_id)
    {
        $newUsers = [];
        $users = User::inRandomOrder()->where(['application_id' => $application_id, 'role_id' => 3])->with('interactions')->limit(50)->get();
        foreach ($users as $user) {
            $block = Block::where(['user_id' => $company_id, 'blocked_id' => $user->id])->first();
            if (!$block) {
                if (!$user->blocked) {
                    $seenInteraction = false;
                    $newInteraction = true;
                    if ($user->interactions) {
                        foreach ($user->interactions as $interaction) {
                            if ($interaction->company_id == $company_id) {
                                $newInteraction = false;
                                if ($interaction->seen) {
                                    $seenInteraction = true;
                                }
                            }
                        }
                    }
                    if (!$seenInteraction) {
                        if ($newInteraction) {
                            $interaction = new Interaction();
                            $interaction->user_id = $user->id;
                            $interaction->company_id = $company_id;
                            $interaction->save();
                        }

                        $interactionUser = User::where('id', $user->id)->with('userData')->with('uploads')->first();
                        $interactionUser->thisInteractionId = $interaction->id;
                        array_push($newUsers, $interactionUser);
                    }
                }
            }
        }
        return $newUsers;

    }
}
