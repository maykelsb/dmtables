import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { TablesComponent } from './tables.component';
import { TableDetailComponent } from './table-detail.component';

import { DashboardComponent } from './dashboard.component';

const ROUTES: Routes = [
  { path: 'tables', component: TablesComponent },
  { path: 'table/:id', component: TableDetailComponent },
  { path: 'dashboard', component: DashboardComponent },
  { path: '', redirectTo: '/dashboard', pathMatch: 'full' }
];

@NgModule({
  imports: [ RouterModule.forRoot(ROUTES) ],
  exports: [ RouterModule ]
})
export class AppRoutingModule {  
}

