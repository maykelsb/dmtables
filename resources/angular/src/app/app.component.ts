import { Component } from '@angular/core'

import { TableService } from './table.service';

@Component({
  selector: 'my-app',
  template: `
  <h1>{{title}}</h1>
  <my-tables></my-tables>
  `,
  providers: [ TableService ]
})
export class AppComponent {
  title = 'Tables Tour';
}

