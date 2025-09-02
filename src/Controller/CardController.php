<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class CardController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $this->EmployeeCards = $this->fetchTable('EmployeeCards');
    }

    public function index($slug = null)
    {
        $this->viewBuilder()->enableAutoLayout(false);

        // Príklad: načítaj prvú existujúcu kartičku (alebo podľa aktuálneho užívateľa)
        $employeeCard = $this->EmployeeCards->find()
            ->where(['EmployeeCards.slug' => $slug])
            ->contain(['PersonalityTypes'])
            ->first();

        // Redirect to edit if personality_type is not set
        if (empty($employeeCard->personality_type)) {
            return $this->redirect(['action' => 'edit', $slug]);
        }

        // Ak nič nenájdeš, tak si priprav prázdnu "dummy" kartu (alebo ošetri vo view)
        if (!$employeeCard) {
            $employeeCard = $this->EmployeeCards->newEmptyEntity();
            $employeeCard->name = 'JÁN NOVÁK';
            $employeeCard->photo_url = 'https://randomuser.me/api/portraits/men/75.jpg';
            $employeeCard->about = 'Milujem fantasy knihy, rád riešim nové nápady a občas pečiem chlieb.';
            // atď...
            $employeeCard->favorite_things = "";
            $employeeCard->personality_type = (object)[
                'label_code' => 'INFP-A',
                'label_name' => 'Prostredník',
                'description' => 'INFP sú idealistickí, kreatívni ...'
            ];
        }

        $this->set(compact('employeeCard'));
    }

    public function edit($slug)
    {
        $this->viewBuilder()->setLayout('cardform');

        $employeeCard = $this->EmployeeCards->find()
            ->where(['slug' => $slug])
            ->firstOrFail();

        $this->set(compact('employeeCard'));
        // View bude obsahovať len linky na jednotlivé kroky
    }


    public function editName($slug = null)
    {
        $this->viewBuilder()->setLayout('cardform');

        $employeeCard = $this->EmployeeCards->find()
            ->where(['slug' => $slug])
            ->firstOrFail();

        // Zoznam typov osobnosti (id => "code (label)")
        $personalityTypes = $this->EmployeeCards->PersonalityTypes->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row->code . ' (' . $row->label . ')';
            }
        ])->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $employeeCard = $this->EmployeeCards->patchEntity($employeeCard, $this->request->getData());
            if ($this->EmployeeCards->save($employeeCard)) {
                // Presmeruj na ďalší krok (zároveň mu pošli ID)
                return $this->redirect(['_name' => 'card_edit_photo', $employeeCard->slug]);
            }
            $this->Flash->error('Nepodarilo sa uložiť, skontrolujte údaje.');
        }

        $this->set(compact('employeeCard', 'personalityTypes'));
    }


    public function editPhoto($slug = null)
    {
        $this->viewBuilder()->setLayout('cardform');

        $employeeCard = $this->EmployeeCards->find()
            ->where(['slug' => $slug])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            // Iba pole photo_url (alebo spracuj upload, ak treba)
            $employeeCard = $this->EmployeeCards->patchEntity($employeeCard, $this->request->getData(), [
                'fields' => ['photo_url']
            ]);
            if ($this->EmployeeCards->save($employeeCard)) {
                // Pokračuj na tretí krok
                return $this->redirect(['_name' => 'card_edit_info', $employeeCard->slug]);
            }
            $this->Flash->error('Nepodarilo sa uložiť fotku.');
        }

        $this->set(compact('employeeCard'));
    }

    public function editInfo($slug = null)
    {
        $this->viewBuilder()->setLayout('cardform');

        $employeeCard = $this->EmployeeCards->find()
            ->where(['slug' => $slug])
            ->firstOrFail();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $employeeCard = $this->EmployeeCards->patchEntity(
                $employeeCard,
                $data
            );
            if ($this->EmployeeCards->save($employeeCard)) {
                // Presmeruj napr. na prehliadku karty/slugu
                return $this->redirect(['action' => 'index', $employeeCard->slug]);
            }
            $this->Flash->error('Nepodarilo sa uložiť, skontrolujte údaje.');
        }

        $this->set(compact('employeeCard'));
    }

    // File: src/Controller/CardController.php
    public function list()
    {
        $this->loadModel('EmployeeCards'); // Load the EmployeeCards model
        $employeeCards = $this->EmployeeCards->find('all'); // Fetch all employee cards

        $this->set(compact('employeeCards')); // Pass data to the view
    }


}
