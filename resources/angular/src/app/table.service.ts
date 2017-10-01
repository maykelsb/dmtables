import { Injectable } from '@angular/core';

import { Table } from './table';
import { TABLES } from './mock-tables';

@Injectable()
export class TableService {
  getTables(): Promise<Table[]> {
    return Promise.resolve(TABLES);
  }

  getTablesSlowly(): Promise<Table[]> {
    return new Promise(resolve => {
      setTimeout(() => resolve(this.getTables()), 1000);
    });
  }
}

