<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;
/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 */
class RequestsController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Requests->find()
            ->contain(['Users']);
        $requests = $this->paginate($query);

        $this->set(compact('requests'));
    }

    /**
     * View method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $request = $this->Requests->get($id, contain: ['Users']);
        $this->set(compact('request'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
{
    $request = $this->Requests->newEmptyEntity();
    if ($this->request->is('post')) {
        // Récupérez l'utilisateur connecté
        $user = $this->Authentication->getIdentity();
        
        // Préparez les données de la requête
        $requestData = $this->request->getData();
        $requestData['user_id'] = $user->id; // Ajoutez l'ID de l'utilisateur
        
        $request = $this->Requests->patchEntity($request, $requestData);
        
        if ($this->Requests->save($request)) {
            $this->Flash->success(__('La requête a bien été envoyée'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('La requête n\'a pas pu être envoyée'));
    }
    
    $users = $this->Requests->Users->find('list', limit: 200)->all();
    $this->set(compact('request', 'users'));
}

    /**
     * Edit method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
{
    // Récupérer la demande à modifier
    $request = $this->Requests->get($id);

    if ($this->request->is(['post', 'put'])) {
        // Patch les données du formulaire dans l'entité request
        $request = $this->Requests->patchEntity($request, $this->request->getData());

        // Vérifier si le statut est "accepté"
        if ($request->status === 'accepté') {
            var_dump($request);
            if ($request->request_type === 'artist') {
                // Accéder au modèle 'Artists' via TableRegistry
                $artistsTable = TableRegistry::getTableLocator()->get('Artists');

                // Créer un nouvel artiste
                $artist = $artistsTable->newEntity([
                    'name' => $request->name, // Utilisation de name au lieu de bio
                ]);

                if ($artistsTable->save($artist)) {
                    $this->Flash->success(__('L\'artiste a été ajouté avec succès.'));
                } else {
                    $this->Flash->error(__('Erreur lors de l\'ajout de l\'artiste.'));
                
                }
            } elseif ($request->request_type === 'album') {
                // Accéder au modèle 'Albums' via TableRegistry
                $albumsTable = TableRegistry::getTableLocator()->get('Albums');

                // Ajouter un nouvel album
                $album = $albumsTable->newEntity([
                    'name' => $request->name,
                    'artist_id' => 1, 
                ]);

                if ($albumsTable->save($album)) {
                    $this->Flash->success(__('L\'album a été ajouté avec succès.'));
                } else {
                    $this->Flash->error(__('Erreur lors de l\'ajout de l\'album.'));
                }
            }
        }

        // Sauvegarder la modification de la requête
        if ($this->Requests->save($request)) {
            $this->Flash->success(__('Le statut de la requête a été mis à jour.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('Impossible de mettre à jour la requête.'));
        }
    }

    // Renvoyer l'entité pour la vue
    $this->set(compact('request'));
}
    
    


    /**
     * Delete method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $request = $this->Requests->get($id);
        if ($this->Requests->delete($request)) {
            $this->Flash->success(__('The request has been deleted.'));
        } else {
            $this->Flash->error(__('The request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
