<?php
/**
 * author : tama asrory
 * email : tamaasrory@gmail.com
 */

namespace App\Models\Base;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder make(array $attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder withGlobalScope($identifier, $scope)
 * @method static \Illuminate\Database\Eloquent\Builder withoutGlobalScope($scope)
 * @method static \Illuminate\Database\Eloquent\Builder withoutGlobalScopes(array $scopes = null)
 * @method static \Illuminate\Database\Eloquent\Builder removedScopes()
 * @method static \Illuminate\Database\Eloquent\Builder whereKey($id)
 * @method static \Illuminate\Database\Eloquent\Builder whereKeyNot($id)
 * @method static \Illuminate\Database\Eloquent\Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder orWhere($column, $operator = null, $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder latest($column = null)
 * @method static \Illuminate\Database\Eloquent\Builder oldest($column = null)
 * @method static \Illuminate\Database\Eloquent\Builder hydrate(array $items)
 * @method static \Illuminate\Database\Eloquent\Builder fromQuery($query, $bindings = [])
 * @method static \Illuminate\Database\Eloquent\Builder find($id, $columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder findMany($ids, $columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder findOrFail($id, $columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder findOrNew($id, $columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder firstOrNew(array $attributes, array $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder firstOrCreate(array $attributes, array $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder updateOrCreate(array $attributes, array $values = [])
 * @method static \Illuminate\Database\Eloquent\Builder firstOrFail($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder firstOr($columns = ['*'], \Closure $callback = null)
 * @method static \Illuminate\Database\Eloquent\Builder value($column)
 * @method static \Illuminate\Database\Eloquent\Builder get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder getModels($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder eagerLoadRelations(array $models)
 * @method static \Illuminate\Database\Eloquent\Builder getRelation($name)
 * @method static \Illuminate\Database\Eloquent\Builder cursor()
 * @method static \Illuminate\Database\Eloquent\Builder chunkById($count, callable $callback, $column = null, $alias = null)
 * @method static \Illuminate\Database\Eloquent\Builder pluck($column, $key = null)
 * @method static \Illuminate\Database\Eloquent\Builder paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder simplePaginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder create(array $attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder forceCreate(array $attributes)
 * @method static \Illuminate\Database\Eloquent\Builder update(array $values)
 * @method static \Illuminate\Database\Eloquent\Builder increment($column, $amount = 1, array $extra = [])
 * @method static \Illuminate\Database\Eloquent\Builder decrement($column, $amount = 1, array $extra = [])
 * @method static \Illuminate\Database\Eloquent\Builder delete()
 * @method static \Illuminate\Database\Eloquent\Builder forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder onDelete(\Closure $callback)
 * @method static \Illuminate\Database\Eloquent\Builder scopes(array $scopes)
 * @method static \Illuminate\Database\Eloquent\Builder applyScopes()
 * @method static \Illuminate\Database\Eloquent\Builder with($relations)
 * @method static \Illuminate\Database\Eloquent\Builder without($relations)
 * @method static \Illuminate\Database\Eloquent\Builder newModelInstance($attributes = [])
 * @method static \Illuminate\Database\Eloquent\Builder getQuery()
 * @method static \Illuminate\Database\Eloquent\Builder setQuery($query)
 * @method static \Illuminate\Database\Eloquent\Builder toBase()
 * @method static \Illuminate\Database\Eloquent\Builder getEagerLoads()
 * @method static \Illuminate\Database\Eloquent\Builder setEagerLoads(array $eagerLoad)
 * @method static \Illuminate\Database\Eloquent\Builder getModel()
 * @method static \Illuminate\Database\Eloquent\Builder setModel(Model $model)
 * @method static \Illuminate\Database\Eloquent\Builder qualifyColumn($column)
 * @method static \Illuminate\Database\Eloquent\Builder getMacro($name)
 * @method static \Illuminate\Database\Query\Builder select($columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder selectSub($query, $as)
 * @method static \Illuminate\Database\Query\Builder selectRaw($expression, array $bindings = [])
 * @method static \Illuminate\Database\Query\Builder fromSub($query, $as)
 * @method static \Illuminate\Database\Query\Builder fromRaw($expression, $bindings = [])
 * @method static \Illuminate\Database\Query\Builder addSelect($column)
 * @method static \Illuminate\Database\Query\Builder distinct()
 * @method static \Illuminate\Database\Query\Builder from($table)
 * @method static \Illuminate\Database\Query\Builder join($table, $first, $operator = null, $second = null, $type = 'inner', $where = false)
 * @method static \Illuminate\Database\Query\Builder joinWhere($table, $first, $operator, $second, $type = 'inner')
 * @method static \Illuminate\Database\Query\Builder joinSub($query, $as, $first, $operator = null, $second = null, $type = 'inner', $where = false)
 * @method static \Illuminate\Database\Query\Builder leftJoin($table, $first, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder leftJoinWhere($table, $first, $operator, $second)
 * @method static \Illuminate\Database\Query\Builder leftJoinSub($query, $as, $first, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder rightJoin($table, $first, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder rightJoinWhere($table, $first, $operator, $second)
 * @method static \Illuminate\Database\Query\Builder rightJoinSub($query, $as, $first, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder crossJoin($table, $first = null, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder mergeWheres($wheres, $bindings)
 * @method static \Illuminate\Database\Query\Builder prepareValueAndOperator($value, $operator, $useDefault = false)
 * @method static \Illuminate\Database\Query\Builder whereColumn($first, $operator = null, $second = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereColumn($first, $operator = null, $second = null)
 * @method static \Illuminate\Database\Query\Builder whereRaw($sql, $bindings = [], $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereRaw($sql, $bindings = [])
 * @method static \Illuminate\Database\Query\Builder whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static \Illuminate\Database\Query\Builder orWhereIn($column, $values)
 * @method static \Illuminate\Database\Query\Builder whereNotIn($column, $values, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereNotIn($column, $values)
 * @method static \Illuminate\Database\Query\Builder whereIntegerInRaw($column, $values, $boolean = 'and', $not = false)
 * @method static \Illuminate\Database\Query\Builder whereIntegerNotInRaw($column, $values, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder whereNull($column, $boolean = 'and', $not = false)
 * @method static \Illuminate\Database\Query\Builder orWhereNull($column)
 * @method static \Illuminate\Database\Query\Builder whereNotNull($column, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder whereBetween($column, array $values, $boolean = 'and', $not = false)
 * @method static \Illuminate\Database\Query\Builder orWhereBetween($column, array $values)
 * @method static \Illuminate\Database\Query\Builder whereNotBetween($column, array $values, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereNotBetween($column, array $values)
 * @method static \Illuminate\Database\Query\Builder orWhereNotNull($column)
 * @method static \Illuminate\Database\Query\Builder whereDate($column, $operator, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereDate($column, $operator, $value = null)
 * @method static \Illuminate\Database\Query\Builder whereTime($column, $operator, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereTime($column, $operator, $value = null)
 * @method static \Illuminate\Database\Query\Builder whereDay($column, $operator, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereDay($column, $operator, $value = null)
 * @method static \Illuminate\Database\Query\Builder whereMonth($column, $operator, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereMonth($column, $operator, $value = null)
 * @method static \Illuminate\Database\Query\Builder whereYear($column, $operator, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereYear($column, $operator, $value = null)
 * @method static \Illuminate\Database\Query\Builder whereNested(\Closure $callback, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder forNestedWhere()
 * @method static \Illuminate\Database\Query\Builder addNestedWhereQuery($query, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder whereExists(\Closure $callback, $boolean = 'and', $not = false)
 * @method static \Illuminate\Database\Query\Builder orWhereExists(\Closure $callback, $not = false)
 * @method static \Illuminate\Database\Query\Builder whereNotExists(\Closure $callback, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereNotExists(\Closure $callback)
 * @method static \Illuminate\Database\Query\Builder addWhereExistsQuery(self $query, $boolean = 'and', $not = false)
 * @method static \Illuminate\Database\Query\Builder whereRowValues($columns, $operator, $values, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereRowValues($columns, $operator, $values)
 * @method static \Illuminate\Database\Query\Builder whereJsonContains($column, $value, $boolean = 'and', $not = false)
 * @method static \Illuminate\Database\Query\Builder orWhereJsonContains($column, $value)
 * @method static \Illuminate\Database\Query\Builder whereJsonDoesntContain($column, $value, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereJsonDoesntContain($column, $value)
 * @method static \Illuminate\Database\Query\Builder whereJsonLength($column, $operator, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orWhereJsonLength($column, $operator, $value = null)
 * @method static \Illuminate\Database\Query\Builder dynamicWhere($method, $parameters)
 * @method static \Illuminate\Database\Query\Builder groupBy(...$groups)
 * @method static \Illuminate\Database\Query\Builder having($column, $operator = null, $value = null, $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orHaving($column, $operator = null, $value = null)
 * @method static \Illuminate\Database\Query\Builder havingBetween($column, array $values, $boolean = 'and', $not = false)
 * @method static \Illuminate\Database\Query\Builder havingRaw($sql, array $bindings = [], $boolean = 'and')
 * @method static \Illuminate\Database\Query\Builder orHavingRaw($sql, array $bindings = [])
 * @method static \Illuminate\Database\Query\Builder orderBy($column, $direction = 'asc')
 * @method static \Illuminate\Database\Query\Builder orderByDesc($column)
 * @method static \Illuminate\Database\Query\Builder inRandomOrder($seed = '')
 * @method static \Illuminate\Database\Query\Builder orderByRaw($sql, $bindings = [])
 * @method static \Illuminate\Database\Query\Builder skip($value)
 * @method static \Illuminate\Database\Query\Builder offset($value)
 * @method static \Illuminate\Database\Query\Builder take($value)
 * @method static \Illuminate\Database\Query\Builder limit($value)
 * @method static \Illuminate\Database\Query\Builder forPage($page, $perPage = 15)
 * @method static \Illuminate\Database\Query\Builder forPageBeforeId($perPage = 15, $lastId = 0, $column = 'id')
 * @method static \Illuminate\Database\Query\Builder forPageAfterId($perPage = 15, $lastId = 0, $column = 'id')
 * @method static \Illuminate\Database\Query\Builder union($query, $all = false)
 * @method static \Illuminate\Database\Query\Builder unionAll($query)
 * @method static \Illuminate\Database\Query\Builder lock($value = true)
 * @method static \Illuminate\Database\Query\Builder lockForUpdate()
 * @method static \Illuminate\Database\Query\Builder sharedLock()
 * @method static \Illuminate\Database\Query\Builder toSql()
 * @method static \Illuminate\Database\Query\Builder getCountForPagination($columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder implode($column, $glue = '')
 * @method static \Illuminate\Database\Query\Builder exists()
 * @method static \Illuminate\Database\Query\Builder doesntExist()
 * @method static \Illuminate\Database\Query\Builder count($columns = '*')
 * @method static \Illuminate\Database\Query\Builder min($column)
 * @method static \Illuminate\Database\Query\Builder max($column)
 * @method static \Illuminate\Database\Query\Builder sum($column)
 * @method static \Illuminate\Database\Query\Builder avg($column)
 * @method static \Illuminate\Database\Query\Builder average($column)
 * @method static \Illuminate\Database\Query\Builder aggregate($function, $columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder numericAggregate($function, $columns = ['*'])
 * @method static \Illuminate\Database\Query\Builder insert(array $values)
 * @method static \Illuminate\Database\Query\Builder insertGetId(array $values, $sequence = null)
 * @method static \Illuminate\Database\Query\Builder insertUsing(array $columns, $query)
 * @method static \Illuminate\Database\Query\Builder updateOrInsert(array $attributes, array $values = [])
 * @method static \Illuminate\Database\Query\Builder truncate()
 * @method static \Illuminate\Database\Query\Builder newQuery()
 * @method static \Illuminate\Database\Query\Builder raw($value)
 * @method static \Illuminate\Database\Query\Builder getBindings()
 * @method static \Illuminate\Database\Query\Builder getRawBindings()
 * @method static \Illuminate\Database\Query\Builder setBindings(array $bindings, $type = 'where')
 * @method static \Illuminate\Database\Query\Builder addBinding($value, $type = 'where')
 * @method static \Illuminate\Database\Query\Builder mergeBindings(self $query)
 * @method static \Illuminate\Database\Query\Builder getConnection()
 * @method static \Illuminate\Database\Query\Builder getProcessor()
 * @method static \Illuminate\Database\Query\Builder getGrammar()
 * @method static \Illuminate\Database\Query\Builder useWritePdo()
 * @method static \Illuminate\Database\Query\Builder cloneWithout(array $properties)
 * @method static \Illuminate\Database\Query\Builder cloneWithoutBindings(array $except)
 * @property-read mixed $created_at
 * @property-read mixed $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SelfModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SelfModel query()
 * @mixin \Eloquent
 */
class SelfModel extends Model
{
    /**
     * The attributes that are select columns.
     *
     * @var array
     */
    public $selectCols = ['*'];

    /**
     * The attributes that are searchable.
     *
     * @var array
     */
    public $searchable = [];

    /**
     * @var array
     */
    public $appends = [];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone(env('APP_TIMEZONE'))
            ->toDateTimeString(); //remove this one if u want to return Carbon object
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone(env('APP_TIMEZONE'))
            ->toDateTimeString(); //remove this one if u want to return Carbon object
    }
}
