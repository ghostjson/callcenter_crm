<?php

namespace App\Http\Middleware;

use App\Classes\Reply;
use Closure;
use Illuminate\Support\Facades\Redirect;

class PermissionCheckMiddleware
{

     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guard('admin')->check()){
            $user = auth()->guard('admin')->user();
            $routeName = $request->route()->getName();
            $errorMessage = Reply::error('messages.notAllowed');
            $errorView = 'errors.403';

            // region Campaigns
            if($routeName == 'admin2.campaigns.index' && !$user->ability('admin', 'campaign_view,campaign_view_all'))
            {
                return response()->view($errorView);
            }else if($routeName == 'admin2.campaigns.create' && !$user->ability('admin', 'campaign_create'))
            {
                return response()->view($errorView);
            } else if($routeName == 'admin2.campaigns.store' && !$user->ability('admin', 'campaign_create'))
            {
                return response()->json($errorMessage);
            } else if($routeName == 'admin2.campaigns.edit' && !$user->ability('admin', 'campaign_edit'))
            {
                return response()->view($errorView);
            } else if($routeName == 'admin2.campaigns.update' && !$user->ability('admin', 'campaign_edit'))
            {
                return response()->json($errorMessage);
            } else if($routeName == 'admin2.campaigns.destroy' && !$user->ability('admin', 'campaign_delete'))
            {
                return response()->json($errorMessage);
            }
            //endregion

            // region Staff Member
            if($routeName == 'admin2.users.create' && !$user->ability('admin', 'staff_create'))
            {
                return response()->view($errorView);
            } else if($routeName == 'admin2.users.store' && !$user->ability('admin', 'staff_create'))
            {
                return response()->json($errorMessage);
            } else if($routeName == 'admin2.users.edit' && !$user->ability('admin', 'staff_edit'))
            {
                return response()->view($errorView);
            } else if($routeName == 'admin2.users.update' && !$user->ability('admin', 'staff_edit'))
            {
                return response()->json($errorMessage);
            } else if($routeName == 'admin2.users.destroy' && !$user->ability('admin', 'staff_delete'))
            {
                return response()->json($errorMessage);
            }
            //endregion

            // region Sales Member
            if($routeName == 'admin2.sales-users.create' && !$user->ability('admin', 'sales_member_create'))
            {
                return response()->view($errorView);
            } else if($routeName == 'admin2.sales-users.store' && !$user->ability('admin', 'sales_member_create'))
            {
                return response()->json($errorMessage);
            } else if($routeName == 'admin2.sales-users.edit' && !$user->ability('admin', 'sales_member_edit'))
            {
                return response()->view('errors.403');
            } else if($routeName == 'admin2.sales-users.update' && !$user->ability('admin', 'sales_member_edit'))
            {
                return response()->json($errorMessage);
            } else if($routeName == 'admin2.sales-users.destroy' && !$user->ability('admin', 'sales_member_delete'))
            {
                return response()->json($errorMessage);
            }
            //endregion

            // region Email Templates
            if($routeName == 'admin2.email-templates.index' && !$user->ability('admin', 'email_template_view,email_template_view_all'))
            {
                return response()->view($errorView);
            } else if($routeName == 'admin2.email-templates.create' && !$user->ability('admin', 'email_template_create'))
            {
                return response()->view($errorView);
            } else if($routeName == 'admin2.email-templates.store' && !$user->ability('admin', 'email_template_create'))
            {
                return response()->json($errorMessage);
            } else if($routeName == 'admin2.email-templates.edit' && !$user->ability('admin', 'email_template_edit'))
            {
                return response()->view('errors.403');
            } else if($routeName == 'admin2.email-templates.update' && !$user->ability('admin', 'email_template_edit'))
            {
                return response()->json($errorMessage);
            } else if($routeName == 'admin2.email-templates.destroy' && !$user->ability('admin', 'email_template_delete'))
            {
                return response()->json($errorMessage);
            }
            //endregion

            // region Forms
            if($routeName == 'admin2.forms.index' && !$user->ability('admin', 'form_view,form_view_all'))
            {
                return response()->view($errorView);
            } else if($routeName == 'admin2.forms.create' && !$user->ability('admin', 'form_create'))
            {
                return response()->view($errorView);
            } else if($routeName == 'admin2.forms.store' && !$user->ability('admin', 'form_create'))
            {
                return response()->json($errorMessage);
            } else if($routeName == 'admin2.forms.edit' && !$user->ability('admin', 'form_edit'))
            {
                return response()->view('errors.403');
            } else if($routeName == 'admin2.forms.update' && !$user->ability('admin', 'form_edit'))
            {
                return response()->json($errorMessage);
            } else if($routeName == 'admin2.forms.destroy' && !$user->ability('admin', 'form_delete'))
            {
                return response()->json($errorMessage);
            }
            //endregion

            // region Import Leads

            if($routeName == 'admin2.campaigns.import-leads' && !$user->ability('admin', 'import_lead'))
            {
                return response()->view($errorView);
            }else if(($routeName == 'admin2.campaigns.import-lead-data' || $routeName == 'admin2.campaigns.save-lead-data') && !$user->ability('admin', 'import_lead'))
            {
                return response()->json($errorMessage);
            }

            // endregion

            // region Export Leads

            if(($routeName == 'admin2.campaigns.export-leads' ||
                    $routeName == 'admin2.campaigns.get-export-leads' ||
                    $routeName == 'admin2.campaigns.download-export-leads'
                ) && !$user->ability('admin', 'export_lead'))
            {
                return response()->view($errorView);
            }

            // endregion
        }

        return $next($request);
    }

}
