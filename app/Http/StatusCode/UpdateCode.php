<?

namespace App\StatusCode;

use Illuminate\Http\Response;

class UpdateCode implements StatusCode
{
    public static function get($success)
    {
        return $success ? Response::HTTP_OK : Response::HTTP_UNPROCESSABLE_ENTITY;
    }
}