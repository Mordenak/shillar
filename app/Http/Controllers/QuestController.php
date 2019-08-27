<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Quest;
use App\QuestTask;
use App\QuestCriteria;
use App\QuestReward;

class QuestController extends Controller
{
	public function create()
		{
		// $forges = ForgeRecipe::all();
		return view('quest.edit');
		}

	public function all(Request $request)
		{
		$quests = Quest::all();
		return view('quest.all', ['quests' => $quests]);
		}

	public function edit($id)
		{
		$Quest = Quest::findOrFail($id);
		return view('quest.edit', ['quest' => $Quest]);
		}

	public function delete($id)
		{
		// clear out shop items:
		$Quest = Quest::findOrFail($request->id);

		$Quest->delete();
		Session::flash('success', 'Quest Deleted!');
		// return $this->all($request);
		return redirect()->action('QuestController@all');
		}

	public function save(Request $request)
		{
		$Quest = new Quest;

		if ($request->id)
			{
			$Quest = Quest::findOrFail($request->id);
			}

		$values = [
			'name' => $request->name,
			'description' => $request->description,
			'completion_message' => $request->completion_message,
			'optional' => $request->optional ? true : false,
			'wisdom_req' => $request->wisdom_req,
			'intelligence_req' => $request->intelligence_req,
			'score_req' => $request->score_req,
			'quest_prereq' => $request->quest_prereq,
			'pickup_rooms_id' => $request->pickup_rooms_id,
			'turnin_rooms_id' => $request->turnin_rooms_id,
			];

		$Quest->fill($values);
		$Quest->save();

		// Rewards:
		$QuestReward = new QuestReward;

		if ($request->reward_id)
			{
			$QuestReward = QuestReward::findOrFail($request->reward_id);
			}

		$reward_values = [
			'quests_id' => $Quest->id,
			'item_reward' => $request->item_reward,
			'xp_reward' => $request->xp_reward,
			'gold_reward' => $request->gold_reward,
			'quest_point_reward' => $request->quest_point_reward,
			'item_choices' => $request->item_choices,
			];

		$QuestReward->fill($reward_values);
		$QuestReward->save();

		// TODO: Cull empty rows:
		// Now criterias:
		foreach ($request->tasks as $task)
			{
			$QuestTask = new QuestTask;

			if (isset($task['id']))
				{
				$QuestTask = QuestTask::findOrFail($task['id']);

				if (!$task['uid'] && !$task['name'] && !$task['description'] && !$task['seq'])
					{
					$QuestTask->delete();
					continue;
					}
				}

			// skip:
			if (!$task['uid'] && !$task['name'] && !$task['description'] && !$task['seq'])
				{
				continue;
				}

			$task_values = [
				'quests_id' => $Quest->id,
				'uid' => $task['uid'],
				'name' => $task['name'],
				'description' => $task['description'],
				'seq' => $task['seq']
				];

			$QuestTask->fill($task_values);
			$QuestTask->save();

			// And now the criteria:
			$QuestCriteria = new QuestCriteria;

			if (isset($task['criteria_id']))
				{
				$QuestCriteria = QuestCriteria::findOrFail($task['criteria_id']);

				// if everything is empty, delete?
				}

			$criteria_values = [
				'quest_tasks_id' => $QuestTask->id,
				'npc_target' => $task['npc_target'],
				'zone_target' => $task['zone_target'],
				'room_target' => $task['room_target'],
				'room_action_target' => $task['room_action_target'],
				'item_target' => $task['item_target'],
				'alignment_target' => $task['alignment_target'],
				'npc_amount' => $task['npc_amount'],
				];

			$QuestCriteria->fill($criteria_values);
			$QuestCriteria->save();
			}

		Session::flash('success', 'Quest Updated!');
		// return $this->edit($Quest->fresh()->id);
		return redirect()->action('QuestController@edit', ['id' => $Quest->id]);
		}
}
