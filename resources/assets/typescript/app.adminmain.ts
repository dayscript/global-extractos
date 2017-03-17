import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';
import { AppModule } from './app.adminmodule';
const platform = platformBrowserDynamic();
platform.bootstrapModule(AppModule);
