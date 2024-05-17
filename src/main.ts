import { BrowserModule, bootstrapApplication } from '@angular/platform-browser';
import { appConfig } from './app/app.config';
import { AppComponent } from './app/app.component';
import { HttpClientModule } from '@angular/common/http';

// bootstrapApplication(AppComponent, appConfig)
//   .catch((err) => console.error(err));


bootstrapApplication(AppComponent, {
  ...appConfig,
  providers: [
    ...(appConfig.providers || [])
  ],
  imports: [ // Ahora TypeScript reconoce la propiedad imports
    BrowserModule,
    HttpClientModule
  ]
} as appConfig) // Convierte el objeto a la nueva interfaz AppConfig
.catch((err) => console.error(err));
