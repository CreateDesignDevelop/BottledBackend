<?php
namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Bottle;
use App\Http\Requests;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Snipe\BanBuilder\CensorWords;
use App\User;
use Illuminate\Database\Query\Builder;

class BottleController extends Controller
{
    use Helpers;
    public function index(Request $request)
    {
        $lat = $request->get('lat');
        $lng = $request->get('lng');

        // $bottles = Bottle::where('user_id','!=', $this->currentUser()->id)
        $bottles = Bottle::where('user_id','!=', $this->currentUser()->id)
            ->where('lat','=',$lat)
            ->where('lng','=',$lng)
            ->where('public','=','true')
            ->orderBy('created_at', 'DESC')
            ->first();

        // No bottles where found
        if( ! $bottles ) {
            return [ "message" => "no bottles where found"];
        }
        $bottles->public = 'false';
        $this->currentUser()->bottles()->save($bottles);

        $user = User::where('id', $bottles->user_id)->first();
        return ["bottles" => $bottles->toArray(), "user" => $user->toArray()];

        return $bottles
            ->toArray();
    }
    public function show($id)
    {
        $bottles = $this->currentUser()->bottles()->find($id);
        if(!$bottles)
            throw new NotFoundHttpException;
        return $bottles;
    }
    public function store(Request $request)
    {
        $bottles              = new bottle;
        $bottles->message     = $request->get('message');
        $bottles->nickname    = $request->get('nickname');
        $bottles->lat         = $request->get('lat');
        $bottles->lng         = $request->get('lng');
        $bottles->public      = $request->get('public');

        $censor = new CensorWords;
        $string = $censor->censorString($bottles->message);
        if ($string['clean'] == $string['orig'])
            if($this->currentUser()->bottles()->save($bottles))
                return $this->response->created();
            else
                return $this->response->error('could_not_create_bottle', 500);
        else
            return $this->response->error('message_banned', 500);
    }
    public function update(Request $request, $id)
    {
        $bottles = $this->currentUser()->bottles()->find($id);
        if(!$bottles)
            throw new NotFoundHttpException;
        $bottles->fill($request->all());
        if($bottles->save())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_update_bottle', 500);
    }
    public function destroy($id)
    {
        $bottles = $this->currentUser()->bottles()->find($id);
        if(!$bottles)
            throw new NotFoundHttpException;
        if($bottles->delete())
            return $this->response->noContent();
        else
            return $this->response->error('could_not_delete_bottle', 500);
    }
    private function currentUser() {
        return JWTAuth::parseToken()->authenticate();
    }
}
