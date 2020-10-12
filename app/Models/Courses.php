<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Courses extends Model
{

    use Notifiable;

    protected $fillable = [
        'id', 'name', 'specialty_ids', 'status', 'start_date', 'end_date', 'duration', 'credit', 'videos', 'books', 'cost', 'content',
    ];

    /**
     * @return array
     */
    public static function getStatus()
    {
        return [
            'active' => __('messages.course_status_active'),
            'delete' => __('messages.course_status_delete'),
            'archive' => __('messages.course_status_archive')
        ];
    }

    /**
     * Get the user that owns the account.
     */
    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    /**
     * Get the spec that owns the specialties.
     */
    public function spec()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }

    /**
     * @param $key
     * @return string
     */
    public function creditByKey($key)
    {
        if (!empty($this->credit)) {
            $credit = (array)json_decode($this->credit);
            $parse_to_collect = collect($credit);

            $find_in_object = $parse_to_collect->first(function ($item) use ($key) {
                return $item->name == $key;
            });

            if (!empty($find_in_object)) {
                return $find_in_object->credit;
            }
        }

        return '';
    }

    /**
     * @param bool $onlyNames
     * @return array
     */
    public function getSpecialtyList($onlyNames = false)
    {
        $speciality_list = [];

        if ($this->specialty_ids) {
            $spec_ids = json_decode($this->specialty_ids);

            if (!empty($spec_ids)) {
                foreach ($spec_ids as $spec_id) {
                    $specialties = Specialty::query()->find($spec_id);

                    if (!empty($specialties)) {
                        if ($onlyNames) {
                            $speciality_list[] = $specialties->name;
                        } else {
                            $speciality_list[] = [
                                "id" => $specialties->id,
                                "name" => $specialties->name
                            ];
                        }
                    }
                }
            }
        }

        return $speciality_list;
    }

    /**
     * @param bool $onlyLink
     * @return array
     */
    public function getVideoList($onlyLink = false)
    {
        $video_list = [];

        if ($this->videos) {
            $videos_ids = json_decode($this->videos);

            if (!empty($videos_ids)) {
                foreach ($videos_ids as $videos_id) {
                    $video = Videos::query()->find($videos_id);

                    if ($video) {
                        $src = sprintf("%s/%s", env('AWS_URL_ACL'), $video->path);

                        if ($onlyLink) {
                            $video_list[] = $src;
                        } else {
                            $video_list[] = [
                                "src" => $src,
                                "title" => $video->title
                            ];
                        }
                    }
                }
            }
        }

        return $video_list;
    }

    /**
     * @param bool $onlyLink
     * @return array
     */
    public function getBookList($onlyLink = false)
    {
        $book_list = [];

        if ($this->books) {
            $books_ids = json_decode($this->books);

            if (!empty($books_ids)) {
                foreach ($books_ids as $books_id) {
                    $book = Book::query()->find($books_id);

                    if ($book) {
                        $src = sprintf("%s/%s", env('AWS_URL_ACL'), $book->path);

                        if ($onlyLink) {
                            $book_list[] = $src;
                        } else {
                            $book_list[] = [
                                "src" => $src,
                                "title" => $book->title
                            ];
                        }
                    }
                }
            }
        }

        return $book_list;
    }

    /**
     * @param Courses $model
     * @return array
     */
    public function exportData(Courses $model)
    {
        return [
            $model->id,
            $model->name,
            __(sprintf('messages.course_status_%s', $model->status)),
            implode(", ", $model->getSpecialtyList(true)),
            $model->start_date,
            $model->end_date,
            $model->duration,
            $model->creditByKey('theoretical'),
            $model->creditByKey('practical'),
            $model->creditByKey('selfeducation'),
            $model->cost,
            implode(", ", $model->getVideoList(true)),
            implode(", ", $model->getBookList(true)),
            $model->content,
            $model->created_at,
            $model->updated_at
        ];
    }

    /**
     * @return array
     */
    public function headings()
    {
        return [
            '#',
            __('messages.name'),
            __('messages.course_status'),
            __('messages.course_list'),
            __('messages.course_start_date'),
            __('messages.course_end_date'),
            __('messages.duration'),
            __('messages.theoretical'),
            __('messages.practical'),
            __('messages.selfeducation'),
            __('messages.cost'),
            __('messages.videos'),
            __('messages.books'),
            __('messages.content'),
            __('messages.created_at'),
            __('messages.updated_at')
        ];
    }
}
