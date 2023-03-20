<?php

namespace App\Http\Controllers\Admin\Crm\Inbox;

use App\Charts\CampaignChart;
use App\Charts\SourceChart;
use App\Http\Controllers\Controller;
use App\Models\ClientMessage;
use App\Models\ClientMessageArgument;
use Illuminate\Http\Request;

class RaportController extends Controller
{
    public function index(Request $request)
    {

        $sources = ClientMessageArgument::select(['argument', 'value'])
            ->where('argument', 'source')
            ->distinct()
            ->pluck('value');

        $campaigns = ClientMessageArgument::select(['argument', 'value'])
            ->where('argument', 'campaign')
            ->distinct()
            ->pluck('value');

        $messages = ClientMessage::with('utms')
            ->when($request->get('date_from'), function($query) use ($request) {
                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->get('date_from'))));
            })
            ->when($request->get('date_to'), function($query) use ($request) {
                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->get('date_to'))));
            })
            ->get();

        foreach($messages as $m){
            foreach ($m->utms as $element)
            {
                $m[$element->argument.'_utm'] = $element->value;
            }
            unset($m->utms);
        }

        if($request->get('source')){
            $messages = $messages->filter(function ($value) use ($request) {
                return $value->source_utm == $request->get('source');
            });
        }

        if($request->get('campaign')){
            $messages = $messages->filter(function ($value) use ($request) {
                return $value->campaign_utm == $request->get('campaign');
            });
        }

        $messages_campaigns = $messages->groupBy('campaign_utm')->map->count();
        $messages_sources = $messages->groupBy('source_utm')->map->count();

        $campaigns_chart = new CampaignChart();
        $campaigns_chart->labels($messages_campaigns->keys()->all());
        $campaigns_chart->dataset('Wiadomości', 'bar', $messages_campaigns->values()->all());

        $sources_chart = new SourceChart();
        $sources_chart->labels($messages_sources->keys()->all());
        $sources_chart->dataset('Źródło', 'bar', $messages_sources->values()->all());

        return view('admin.crm.raport.index', compact([
            'sources',
            'campaigns',
            'messages',
            'messages_campaigns',
            'messages_sources',
            'campaigns_chart',
            'sources_chart'
        ]));
    }
}
