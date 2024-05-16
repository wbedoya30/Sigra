import { ApplicationConfig, Type } from '@angular/core';
import { provideRouter } from '@angular/router';
import { routes } from './app.routes';

// export const appConfig: ApplicationConfig = {
//   providers: [provideRouter(routes)]
// };

export const appConfig: ApplicationConfig = {
  providers: [
    provideRouter(routes),
    // provideHttpClient(),
    // provideClientHydration(),
  ]
};
export interface appConfig extends ApplicationConfig {
  imports: Type<any>[];
}
