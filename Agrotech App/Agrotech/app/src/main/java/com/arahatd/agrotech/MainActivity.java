package com.arahatd.agrotech;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.Color;
import android.graphics.Typeface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.Toast;

import im.delight.android.webview.AdvancedWebView;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.res.ResourcesCompat;

import com.google.android.material.bottomnavigation.BottomNavigationView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

/**
 * The MainActivity class represents the main activity of the AgroTech application.
 * It displays a WebView that loads a web page and provides navigation through a bottom navigation view.
 */
public class MainActivity extends AppCompatActivity implements AdvancedWebView.Listener {

    private static final String TEST_PAGE_URL = "TEST_PAGE_URL";
    private AdvancedWebView mWebView;
    ProgressBar progressBar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        progressBar = findViewById(R.id.progressBar);

        // Initialize and assign variables
        BottomNavigationView bottomNavigationView = (BottomNavigationView) findViewById(R.id.bottom_navigation);

        // Set Home selected
        bottomNavigationView.setSelectedItemId(R.id.home);

        mWebView = (AdvancedWebView) findViewById(R.id.webview);
        mWebView.setVerticalScrollBarEnabled(true);

        mWebView.setListener(this, this);
        mWebView.setGeolocationEnabled(false);
        mWebView.setMixedContentAllowed(true);
        mWebView.setCookiesEnabled(true);
        mWebView.setThirdPartyCookiesEnabled(true);

        mWebView.setWebViewClient(new WebViewClient() {

            @Override
            public void onPageFinished(WebView view, String url) {
                Toast.makeText(MainActivity.this, "Finished loading", Toast.LENGTH_SHORT).show();
            }

        });

        mWebView.setWebChromeClient(new WebChromeClient() {

            @Override
            public void onReceivedTitle(WebView view, String title) {
                super.onReceivedTitle(view, title);
                Toast.makeText(MainActivity.this, title, Toast.LENGTH_SHORT).show();
            }

        });

        mWebView.addHttpHeader("X-Requested-With", "");
        mWebView.loadUrl(TEST_PAGE_URL);

        // Perform item selected listener
        bottomNavigationView.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {

                switch(item.getItemId()) {
                    case R.id.temp:
                        startActivity(new Intent(getApplicationContext(), TempActivity.class));
                        overridePendingTransition(0, 0);
                        return true;
                    case R.id.home:
                        return true;
                    case R.id.hum:
                        startActivity(new Intent(getApplicationContext(), HumActivity.class));
                        overridePendingTransition(0, 0);
                        return true;
                }
                return false;
            }
        });
    }

    @SuppressLint("NewApi")
    @Override
    protected void onResume() {
        super.onResume();
        mWebView.onResume();
    }

    @SuppressLint("NewApi")
    @Override
    protected void onPause() {
        mWebView.onPause();
        super.onPause();
    }

    @Override
    protected void onDestroy() {
        mWebView.onDestroy();
        super.onDestroy();
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent intent) {
        super.onActivityResult(requestCode, resultCode, intent);
        mWebView.onActivityResult(requestCode, resultCode, intent);
    }

    @Override
    public void onBackPressed() {
        Intent a = new Intent(Intent.ACTION_MAIN);
        a.addCategory(Intent.CATEGORY_HOME);
        a.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        startActivity(a);
    }

    @Override
    public void onPageStarted(String url, Bitmap favicon) {
        mWebView.setVisibility(View.INVISIBLE);
    }

    @Override
    public void onPageFinished(String url) {
        mWebView.setVisibility(View.VISIBLE);
        progressBar.setVisibility(View.GONE);
    }

    @Override
    public void onPageError(int errorCode, String description, String failingUrl) {
        Toast.makeText(MainActivity.this, "onPageError(errorCode = " + errorCode + ",  description = " + description + ",  failingUrl = " + failingUrl + ")", Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onDownloadRequested(String url, String suggestedFilename, String mimeType, long contentLength, String contentDisposition, String userAgent) {
        Toast.makeText(MainActivity.this, "onDownloadRequested(url = " + url + ",  suggestedFilename = " + suggestedFilename + ",  mimeType = " + mimeType + ",  contentLength = " + contentLength + ",  contentDisposition = " + contentDisposition + ",  userAgent = " + userAgent + ")", Toast.LENGTH_LONG).show();
    }

    @Override
    public void onExternalPageRequest(String url) {
        Toast.makeText(MainActivity.this, "onExternalPageRequest(url = " + url + ")", Toast.LENGTH_SHORT).show();
    }
}
