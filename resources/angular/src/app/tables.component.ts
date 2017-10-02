import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { Table } from './table';
import { TableService } from './table.service';

@Component({
  selector: 'my-tables',
  templateUrl: './tables.component.html',
  styleUrls: [ './tables.component.css' ]
})

export class TablesComponent implements OnInit {
  title = 'RPGtables';
  tables: Table[];
  selectedTable: Table;

  constructor(
    private tableService: TableService,
    private router: Router
  ) {
  }

  ngOnInit(): void {
    this.getTables();
  }

  onSelect(table: Table): void {
    this.selectedTable = table;
  }

  getTables(): void {
    this.tableService.getTablesSlowly().then(tables => this.tables = tables);
  }

  goToTable(): void {
    this.router.navigate(['/table', this.selectedTable.id]);
  }
}

