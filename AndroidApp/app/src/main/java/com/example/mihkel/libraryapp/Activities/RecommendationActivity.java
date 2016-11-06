package com.example.mihkel.libraryapp.Activities;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.Toast;

import com.example.mihkel.libraryapp.Interfaces.ParseStringCallBackListener;
import com.example.mihkel.libraryapp.R;
import com.example.mihkel.libraryapp.Various.AuthorListAdapter;

import java.util.Arrays;
import java.util.List;

public class RecommendationActivity extends AppCompatActivity implements View.OnClickListener, ParseStringCallBackListener {

    public Integer visibleLevel = 0;
    public Integer activeLevel = 0;

    //    private Fragment authorFragment;
    private LinearLayout sexLayout;
    private LinearLayout previouslyLikedLayout;
    private LinearLayout authorLayout;
    private LinearLayout genreLayout;
    private LinearLayout keywordsLayout;
    private LinearLayout likesReadingLayout;
    private Button nextButton;
    private Button previousButton;
    private AutoCompleteTextView autocompleteView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_recommendation);

        sexLayout = (LinearLayout) findViewById(R.id.sexLayout);
        previouslyLikedLayout = (LinearLayout) findViewById(R.id.previouslyLikedLayout);
        authorLayout = (LinearLayout) findViewById(R.id.authorLayout);
        genreLayout = (LinearLayout) findViewById(R.id.genreLayout);
        keywordsLayout = (LinearLayout) findViewById(R.id.keywordsLayout);
        likesReadingLayout = (LinearLayout) findViewById(R.id.likesReadingLayout);

        nextButton = (Button) findViewById(R.id.nextButton);
        nextButton.setOnClickListener(this);

        previousButton = (Button) findViewById(R.id.previousButton);
        previousButton.setOnClickListener(this);

        autocompleteView = (AutoCompleteTextView) findViewById(R.id.editAuthor);
        handleEditAuthor();
        hideAll();

//        LinearLayout ageLayout = (LinearLayout) findViewById(R.id.age);

//        authorFragment = getSupportFragmentManager().findFragmentById(R.id.authorFragment);
//        TextView textView = (TextView) authorFragment.getView().findViewById(R.id.textView2);
//        textView.setText("aaaaaaaaaaa");

    }


    public void handleEditAuthor() {
//        int layoutItemId = android.R.layout.simple_dropdown_item_1line;
        int layoutItemId = R.layout.dropdown;
//        String[] dogsArr = getResources().getStringArray(R.array.dogs_list);
//        List<String> dogList = Arrays.asList(dogsArr);

        String[] arr = { "Paries,France", "PA,United States","Parana,Brazil", "Padua,Italy", "Pasadena,CA,United States"};

        ArrayAdapter<String> adapter = new ArrayAdapter<>(this, layoutItemId, arr);
//        AuthorListAdapter<String> adapter = new AuthorListAdapter<>(this, layoutItemId, arr);
        autocompleteView.setAdapter(adapter);
        autocompleteView.setThreshold(1);

//        autocompleteView.setDropDownAnchor();
    }

    public void hideAll() {
        sexLayout.setVisibility(View.GONE);
        previouslyLikedLayout.setVisibility(View.GONE);
        authorLayout.setVisibility(View.GONE);
        genreLayout.setVisibility(View.GONE);
        keywordsLayout.setVisibility(View.GONE);
        likesReadingLayout.setVisibility(View.GONE);
    }


    //------------------------------------------------------------------------------------------------------
    // DRAWING FIELDS start:
    //------------------------------------------------------------------------------------------------------
    public void showToLevel(int level) {
        if (level >= 0)
            showAgeField();
        if (level >= 1)
            showSexField();
        if (level >= 2)
            showLikesReadingField();
        if (level >= 3)
            showLanguageField();
        if (level >= 4)
            showAuthorField();
        if (level >= 5)
            showGenreField();
        if (level >= 6)
            showYearField();
        if (level >= 7)
            showPreviouslyLikedField();
        if (level >= 8)
            showKeyWordsField();
    }

    public void showAgeField() {

    }

    public void showSexField() {
        sexLayout.setVisibility(View.VISIBLE);
    }

    public void showLikesReadingField() {
        likesReadingLayout.setVisibility(View.VISIBLE);
    }

    public void showLanguageField() {
//        lan.setVisibility(View.VISIBLE);

    }

    public void showAuthorField() {
        authorLayout.setVisibility(View.VISIBLE);
    }

    public void showGenreField() {
        genreLayout.setVisibility(View.VISIBLE);

    }

    public void showYearField() {
//        genreLayout.setVisibility(View.VISIBLE);

    }

    public void showPreviouslyLikedField() {
        previouslyLikedLayout.setVisibility(View.VISIBLE);
    }

    public void showKeyWordsField() {
        keywordsLayout.setVisibility(View.VISIBLE);

    }

    //------------------------------------------------------------------------------------------------------
    // DRAWING FIELDS end
    //------------------------------------------------------------------------------------------------------
    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.nextButton:
                showNextField();
                break;
            case R.id.previousButton:
                showPreviousField();
                break;
        }

    }

    private void showPreviousField() {
        visibleLevel--;
        activeLevel--;
        showToLevel(visibleLevel);
        toast("level now: " + visibleLevel);
    }

    private void showNextField() {
        visibleLevel++;
        activeLevel++;
        showToLevel(visibleLevel);
        toast("level now: " + visibleLevel);
    }

    public void startResultActivity() {
//        Intent calendarStartIntent = new Intent(this, SchoolsListActivity.class);
//        startActivity(calendarStartIntent);
//        toast("startRecommendationActivity");
    }

    public void startResult() {
//        if (true || !DatabaseManagerSingleton.getInstance().hasSchoolsList())
//            fetchDataFromServer();
//        else
//            startMandatoryReadingActivity();
    }

    public void toast(String text) {
        Toast.makeText(getApplicationContext(), text, Toast.LENGTH_SHORT).show();
    }

    public void fetchDataFromServer() {
//        JsonTask jsonTask = new JsonTask(RecommendationActivity.this).setListener(this);
//        jsonTask.execute("http://admin-mihkelvilismae.rhcloud.com/AdminInterface/json/Koolid");
    }

    @Override
    public void callback(String jsonString) {
//        DatabaseManagerSingleton.getInstance().setSchoolListResult(jsonString);
//        startMandatoryReadingActivity();
    }

    //-----------------------------------------------------------------------------------------------------------------------
    // DEFAULT start:
    //-----------------------------------------------------------------------------------------------------------------------

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }


}
