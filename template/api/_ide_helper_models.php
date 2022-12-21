<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Base{
/**
 * Class Role
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
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $permission
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models\Base{
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
 */
	class SelfModel extends \Eloquent {}
}

namespace App\Models\Base{
/**
 * Class User
 *
 * @package App
 * @property string $id
 * @property string $name
 * @property string $no_hp
 * @property array $role
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property array $detail
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $role_id
 * @property-read mixed $perm
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\Authenticatable, \Illuminate\Contracts\Auth\Access\Authorizable {}
}

namespace App\Models{
/**
 * App\Models\Building
 *
 * @property integer $id
 * @property array $detail {"kode":"?","name":"?"}
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Building newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Building newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Building query()
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereUpdatedAt($value)
 */
	class Building extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Floor
 *
 * @property integer $id
 * @property string $detail {"kode":"?","name":"?","canvas":"?","building":"?"}
 * @property string $created_at
 * @property string $updated_at
 * @property-read mixed $building
 * @method static \Illuminate\Database\Eloquent\Builder|Floor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Floor whereUpdatedAt($value)
 */
	class Floor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Location
 *
 * @property integer $id
 * @property array $detail {"kode":"?","x":0,"y":0,"floor":"?"}
 * @property string $created_at
 * @property string $updated_at
 * @property-read mixed $floor
 * @property-read mixed $trap_type
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 */
	class Location extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mapping
 *
 * @property integer $id
 * @property array $detail {"kode":"QR Trap","location":"?","trap":"?","pesticide":"?"}
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Mapping newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mapping newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mapping query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mapping whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mapping whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mapping whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mapping whereUpdatedAt($value)
 */
	class Mapping extends \Eloquent {}
}

namespace App\Models\Base{
/**
 * App\Models\Permissions
 *
 * @property integer $id
 * @property string $name
 * @property string $guard_name
 * @property string $created_at
 * @property string $updated_at
 * @property ModelHasPermission[] $modelHasPermissions
 * @property Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permissions whereUpdatedAt($value)
 */
	class Permissions extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pest
 *
 * @property integer $id
 * @property array $detail {"name":"?"}
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Pest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pest query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereUpdatedAt($value)
 */
	class Pest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pesticide
 *
 * @property integer $id
 * @property array $detail {"name":"?","total":"?","unit":"?"}
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Pesticide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesticide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesticide query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pesticide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesticide whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesticide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pesticide whereUpdatedAt($value)
 */
	class Pesticide extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Signature
 *
 * @property integer $id
 * @property array $detail
 * @property string $created_at
 * @property string $updated_at
 * @property-read mixed $author
 * @method static \Illuminate\Database\Eloquent\Builder|Signature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Signature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Signature query()
 * @method static \Illuminate\Database\Eloquent\Builder|Signature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signature whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Signature whereUpdatedAt($value)
 */
	class Signature extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TrapType
 *
 * @property integer $id
 * @property array $detail {"kode":"?","symbol":"?","name":"?","color":"?"}
 * @property string $created_at
 * @property string $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TrapType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrapType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TrapType query()
 * @method static \Illuminate\Database\Eloquent\Builder|TrapType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrapType whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrapType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TrapType whereUpdatedAt($value)
 */
	class TrapType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Treatment
 *
 * @property integer $id
 * @property array $detail {"kode":"QR Trap","user":"?","pest":[{"id":"?","detail":{"name":"?","total":"?"}}],"pesticide":{"id":"?","detail":{"name":"?","total":"?","unit":"?"}}}
 * @property string $created_at
 * @property string $updated_at
 * @property-read mixed $approved
 * @property-read mixed $created
 * @property-read mixed $finished
 * @property-read mixed $rejected
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Treatment whereUpdatedAt($value)
 */
	class Treatment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TreatmentDetail
 *
 * @property integer $id
 * @property array $detail {"kode":"QR Trap","user":"?","pest":[{"id":"?","detail":{"name":"?","total":"?"}}],"pesticide":{"id":"?","detail":{"name":"?","total":"?","unit":"?"}}}
 * @property string $created_at
 * @property string $updated_at
 * @property-read mixed $user
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentDetail whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TreatmentDetail whereUpdatedAt($value)
 */
	class TreatmentDetail extends \Eloquent {}
}

