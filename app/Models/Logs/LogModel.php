<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'action',
        'model',
        'model_id',
        'created_at',
    ];

    public $timestamps = false;

    public static function logAction($userId = 0, $action, $model)
    {
        $log = new LogModel();
        $log->user_id = $userId;
        $log->action = $action;
        $log->model = get_class($model);
        $log->model_id = $model->getKey();
        $log->created_at = now();

        $log->save();
    }
}
