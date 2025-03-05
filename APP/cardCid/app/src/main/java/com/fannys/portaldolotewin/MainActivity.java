package com.fannys.portaldolotewin;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.DownloadManager;
import android.content.Context;
import android.content.pm.ActivityInfo;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.print.PrintAttributes;
import android.print.PrintDocumentAdapter;
import android.print.PrintManager;
import android.util.Log;
import android.view.KeyEvent;
import android.webkit.CookieManager;
import android.webkit.DownloadListener;
import android.webkit.JavascriptInterface;
import android.webkit.URLUtil;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.fannys.portaldolotewin.R;

public class MainActivity extends AppCompatActivity {

    private WebView myWebView;

    @SuppressLint("SetJavaScriptEnabled")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);

        // Verifica permissão para escrita (necessária para downloads)
        if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.M) {
            if (checkSelfPermission(Manifest.permission.WRITE_EXTERNAL_STORAGE)
                    == PackageManager.PERMISSION_DENIED) {
                Log.d("permission", "Permissão negada para WRITE_EXTERNAL_STORAGE - solicitando");
                String[] permissions = {Manifest.permission.WRITE_EXTERNAL_STORAGE};
                requestPermissions(permissions, 1);
            }
        }

        // Configura o WebView
        myWebView = findViewById(R.id.webview);
        WebSettings webSettings = myWebView.getSettings();
        webSettings.setJavaScriptEnabled(true);
        webSettings.setSaveFormData(true);
        myWebView.getSettings().setBuiltInZoomControls(true);

        // Adiciona a interface para impressão, disponível no JavaScript como "AndroidInterface"
        myWebView.addJavascriptInterface(new WebAppInterface(this, myWebView), "AndroidInterface");

        // Configura o WebChromeClient e o WebViewClient
        myWebView.setWebChromeClient(new WebChromeClient());
        myWebView.setWebViewClient(new WebViewClient() {
            @Override
            public void onReceivedError(WebView view, int errorCode, String description, String failingUrl) {
                // Em caso de erro, recarrega a tela de login
                myWebView.loadUrl("http://cartcid.free.nf/");
            }
        });

        // Carrega a URL do portal
        myWebView.loadUrl("http://cartcid.free.nf/");

        // Configura o DownloadListener para permitir downloads
        myWebView.setDownloadListener(new DownloadListener() {
            @Override
            public void onDownloadStart(String url, String userAgent,
                                        String contentDisposition, String mimeType,
                                        long contentLength) {
                DownloadManager.Request request = new DownloadManager.Request(Uri.parse(url));
                request.setMimeType(mimeType);
                String cookies = CookieManager.getInstance().getCookie(url);
                request.addRequestHeader("cookie", cookies);
                request.addRequestHeader("User-Agent", userAgent);
                request.setDescription("Baixando arquivo...");
                // Utiliza URLUtil para adivinhar o nome do arquivo
                String fileName = URLUtil.guessFileName(url, contentDisposition, mimeType);
                request.setTitle(fileName);
                request.allowScanningByMediaScanner();
                request.setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED);
                request.setDestinationInExternalPublicDir(Environment.DIRECTORY_DOWNLOADS, fileName);
                DownloadManager dm = (DownloadManager) getSystemService(DOWNLOAD_SERVICE);
                dm.enqueue(request);
                Toast.makeText(getApplicationContext(), "Iniciando download: " + fileName, Toast.LENGTH_LONG).show();
            }
        });
    }

    // Permite que o botão "Voltar" do dispositivo navegue no histórico do WebView
    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        if ((keyCode == KeyEvent.KEYCODE_BACK) && myWebView.canGoBack()) {
            myWebView.goBack();
            return true;
        }
        return super.onKeyDown(keyCode, event);
    }

    /**
     * Interface para expor métodos nativos ao JavaScript.
     * No HTML, você pode chamar: AndroidInterface.printDocument();
     */
    public class WebAppInterface {
        Context mContext;
        WebView mWebView;

        public WebAppInterface(Context context, WebView webView) {
            mContext = context;
            mWebView = webView;
        }

        @JavascriptInterface
        public void printDocument() {
            // Log para confirmar que o método foi chamado
            Log.d("PRINT", "printDocument() chamado pela interface JavaScript");
            // Envia a execução para a thread de UI
            mWebView.post(new Runnable() {
                @Override
                public void run() {
                    if (android.os.Build.VERSION.SDK_INT >= android.os.Build.VERSION_CODES.KITKAT) {
                        PrintManager printManager = (PrintManager) mContext.getSystemService(Context.PRINT_SERVICE);
                        PrintDocumentAdapter printAdapter = mWebView.createPrintDocumentAdapter("Documento_IR");
                        String jobName = mContext.getString(R.string.app_name) + " Documento IR";
                        printManager.print(jobName, printAdapter, new PrintAttributes.Builder().build());
                    } else {
                        Toast.makeText(mContext, "Impressão não suportada neste dispositivo", Toast.LENGTH_SHORT).show();
                    }
                }
            });
        }
    }
}

