<?php

namespace Tests\Feature;

use App\Models\CareerApplication;
use App\Models\ContactMessage;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InboundCmsWorkflowTest extends TestCase
{
    use RefreshDatabase;

    private function makePanelUserWithPermission(string $slug, array $actions = [], ?string $roleTitle = null): User
    {
        $role = Role::create([
            'title_fa' => 'مدیر',
            'title' => $roleTitle ?? ('manager-' . $slug),
            'status' => 4,
        ]);

        $user = User::create([
            'name' => 'Inbound Workflow User',
            'email' => 'workflow-' . $slug . '-' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'level' => 'panel',
            'change_password' => 1,
        ]);

        $user->roles()->attach($role->id);

        $permission = Permission::create([
            'title' => $slug,
            'label' => $slug,
            'slug' => $slug,
            'user_id' => $user->id,
        ]);

        $role->permissions()->attach($permission->id, array_merge([
            'can_view' => false,
            'can_insert' => false,
            'can_edit' => false,
            'can_delete' => false,
        ], $actions));

        return $user;
    }

    public function test_contact_message_status_update_requires_edit_permission(): void
    {
        $message = ContactMessage::create([
            'first_name' => 'Ali',
            'last_name' => 'Test',
            'email' => 'ali@example.com',
            'phone' => '09120000000',
            'subject' => 'Subject',
            'message' => 'Body',
        ]);

        $userNoEdit = $this->makePanelUserWithPermission('contactmessage', ['can_view' => true]);
        $this->actingAs($userNoEdit, 'panel')
            ->patch('/panel/contact-message/' . $message->id . '/status', ['workflow_status' => 'resolved'])
            ->assertForbidden();

        $userEdit = $this->makePanelUserWithPermission('contactmessage', ['can_view' => true, 'can_edit' => true], 'superadmin');
        $this->actingAs($userEdit, 'panel')
            ->patch('/panel/contact-message/' . $message->id . '/status', [
                'workflow_status' => 'resolved',
                'review_note' => 'done',
            ])
            ->assertRedirect('/panel/contact-message/' . $message->id);

        $this->assertDatabaseHas('contact_messages', [
            'id' => $message->id,
            'workflow_status' => 'resolved',
            'review_note' => 'done',
        ]);
    }

    public function test_career_application_status_update_requires_edit_permission(): void
    {
        $application = CareerApplication::create([
            'first_name' => 'Sara',
            'last_name' => 'Test',
            'national_code' => '1234567890',
            'birth_date' => '1990-01-01',
            'gender' => 'female',
            'marital_status' => 'single',
            'email' => 'sara@example.com',
            'phone' => '09121111111',
            'address' => 'addr',
            'city' => 'Tehran',
            'province' => 'Tehran',
            'position' => 'Analyst',
            'expected_salary' => '100',
            'availability' => 'immediate',
            'resume_path' => 'career/resume/a.pdf',
            'terms' => true,
        ]);

        $userNoEdit = $this->makePanelUserWithPermission('careerapplication', ['can_view' => true]);
        $this->actingAs($userNoEdit, 'panel')
            ->patch('/panel/career-application/' . $application->id . '/status', ['workflow_status' => 'shortlisted'])
            ->assertForbidden();

        $userEdit = $this->makePanelUserWithPermission('careerapplication', ['can_view' => true, 'can_edit' => true], 'superadmin');
        $this->actingAs($userEdit, 'panel')
            ->patch('/panel/career-application/' . $application->id . '/status', [
                'workflow_status' => 'shortlisted',
                'review_note' => 'good fit',
            ])
            ->assertRedirect('/panel/career-application/' . $application->id);

        $this->assertDatabaseHas('career_applications', [
            'id' => $application->id,
            'workflow_status' => 'shortlisted',
            'review_note' => 'good fit',
        ]);
    }
}
