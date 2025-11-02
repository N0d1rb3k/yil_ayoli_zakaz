<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Qiz;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Barcha guruhlarni JSON formatida qaytaradi
     */
    public function index()
    {
        $groups = Group::with('qizlar')->get();
        
        return response()->json([
            'success' => true,
            'data' => $groups
        ]);
    }

    /**
     * Yangi guruh yaratadi
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:groups,name',
            'description' => 'nullable|string',
        ]);

        $group = Group::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Guruh muvaffaqiyatli yaratildi',
            'data' => $group
        ], 201);
    }

    /**
     * Barcha Qiz ma'lumotlarini Cardlar uchun JSON sifatida qaytaradi
     */
    public function getQizlarForAdd()
    {
        $qizlar = Qiz::select('id', 'fio', 'yoshi', 'sinfi', 'telefon_raqami', 'rasmi', 'manzili')
            ->orderBy('fio')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $qizlar
        ]);
    }

    /**
     * Berilgan qizni guruhga qo'shadi (syncWithoutDetaching() orqali)
     */
    public function addQiz(Group $group, Qiz $qiz)
    {
        $group->qizlar()->syncWithoutDetaching([$qiz->id]);

        return response()->json([
            'success' => true,
            'message' => "{$qiz->fio} guruhga muvaffaqiyatli qo'shildi",
            'data' => [
                'group' => $group->load('qizlar'),
                'qiz' => $qiz
            ]
        ]);
    }

    /**
     * Guruh a'zolarini ko'rish (GET /groups/{group}/qizlar)
     */
    public function getQizlar(Group $group)
    {
        $qizlar = $group->qizlar()->get();

        return response()->json([
            'success' => true,
            'data' => [
                'group' => $group,
                'qizlar' => $qizlar
            ]
        ]);
    }

    /**
     * Guruh a'zolarini Cardlar ko'rinishida ko'rsatadi
     */
    public function showQizlar(Group $group)
    {
        $group->load('qizlar');
        $canAdd = auth()->check();

        return view('groups.show_qizlar', compact('group', 'canAdd'));
    }

    /**
     * Guruhni yangilaydi
     */
    public function update(Request $request, Group $group)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:groups,name,' . $group->id,
            'description' => 'nullable|string',
        ]);

        $group->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Guruh muvaffaqiyatli yangilandi',
            'data' => $group
        ]);
    }

    /**
     * Guruhni o'chiradi
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json([
            'success' => true,
            'message' => 'Guruh muvaffaqiyatli o\'chirildi'
        ]);
    }
}

