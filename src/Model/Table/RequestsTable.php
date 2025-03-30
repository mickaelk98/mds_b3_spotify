<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Requests Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Request newEmptyEntity()
 * @method \App\Model\Entity\Request newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Request> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Request get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Request findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Request patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Request> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Request|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Request saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Request>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Request>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Request>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Request> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Request>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Request>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Request>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Request> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RequestsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('requests');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('request_type')
            ->requirePresence('request_type', 'create')
            ->notEmptyString('request_type');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('status')
            ->notEmptyString('status');

        return $validator;
    }

    public function createRequest($data, $userId)
{
    $request = $this->newEntity([
        'request_type' => $data['request_type'],
        'name' => $data['name'],
        'user_id' => $userId,
        'status' => 'en cours',
        'details' => $data['details'] ?? null
    ]);

    return $this->save($request);
}

// Méthode pour valider une requête (admin only)
public function validateRequest($requestId, $status)
{
    $request = $this->get($requestId);
    $request->status = $status;
    return $this->save($request);
}

// Méthode pour récupérer les requêtes en attente (admin only)
// public function getPendingRequests()
// {
//     return $this->find('all')
//         ->where(['status' => 'pending'])
//         ->contain(['Users']);
// }

public function getRequests()
{
    return $this->find('all')
        ->contain(['Users']);
}

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
