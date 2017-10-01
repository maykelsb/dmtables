import { Component } from '@angular/core'

import { TableService } from './table.service';

@Component({
  selector: 'my-app',
  template: `
  <h1>{{title}}</h1>
  <nav>
    <a routerLink="/dashboard">Dashboard</a>
    <a routerLink="/tables">Tabelas</a>
  </nav>
  <router-outlet></router-outlet>
  `,
  providers: [ TableService ]
})
export class AppComponent {
  title = 'Tables Tour';
}

