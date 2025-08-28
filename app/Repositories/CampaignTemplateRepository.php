<?php

namespace App\Repositories;

use App\Models\CampaignTemplate;
use App\Repositories\Interfaces\CampaignTemplateRepositoryInterface;

class CampaignTemplateRepository implements CampaignTemplateRepositoryInterface
{
    protected CampaignTemplate $model;

    public function __construct(CampaignTemplate $model)
    {
        $this->model = $model;
    }

    public function all(array $filters = [])
    {
        $query = $this->model->query();

        // Exemple : filtre par catégorie
        if (! empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (! empty($filters['type_campaign_id'])) {
            $query->where('type_campaign_id', $filters['type_campaign_id']);
        }

        return $query->get();
    }

    public function find(int $id)
    {
        return $this->model
            ->with([
                'tags',
                'typeCampaign',
                'category',
                'socialPosts',
            ])
            ->withCount('uses')
            ->withAvg('ratings', 'rating')
            ->findOrFail($id);
    }


    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $template = $this->model->findOrFail($id);
        $template->update($data);

        return $template;
    }

    public function delete(int $id)
    {
        $template = $this->model->findOrFail($id);

        return $template->delete();
    }

    public function findByCategory(string $category)
    {
        return $this->model->where('category', $category)->get();
    }

    public function findByTypeCampaignId(int $typeCampaignId)
    {
        return $this->model->where('type_campaign_id', $typeCampaignId)->get();
    }

    public function allWithAggregates()
    {
        return $this->model
            ->with(['tags', 'typeCampaign', 'category'])
            ->withCount('uses')
            ->withAvg('ratings', 'rating')
            ->get();
    }
}
